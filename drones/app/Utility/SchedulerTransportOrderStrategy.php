<?php
/**
 * Created by PhpStorm.
 * User: Giovanna
 * Date: 12/01/2018
 * Time: 11:06
 */

namespace App\Utility;


use App\Models\Slot;
use App\Models\TransportOrder;
use App\Utility\Scheduler;
use Carbon\Carbon;
use Psy\Input\CodeArgument;

class SchedulerTransportOrderStrategy implements Scheduler
{
	private $transportOrder;

	function __construct($transportOrder) {
		$this->transportOrder = $transportOrder;
	}

    public function getTimeDelivery($journeySlots){

        $orderCarriers = $this->transportOrder->carrier;
        $timeDeliveryArray = [];
        \Log::info('------------------------------');
        foreach ($orderCarriers as $carrier){
            $dronesList = \App\Models\Drone::select('id')->where('type', 'drone')->get();
            $pilotsList = \App\Models\Pilot::select('id')->where('type', 'pilot')->get();
            $journeySlots = (int)$journeySlots;


            $syncTable = new \App\Models\SyncTable();
            $syncTable->inizializzaSyncTable($dronesList, $pilotsList, $journeySlots);
            $carrier->setSyncTable($syncTable);
            $carrier->save();


            $sizeOfDiary = config('slot.numberInADay');
            $droneCollection = new DronesCollection();
            $pilotCollection = new PilotsCollection();
            $technicianCollection = new TechniciansCollection();
            $time[0] = Carbon::Now()->hour +1;
            if($time[0] == 24){$time[0]=0;}
            $time[1] = Carbon::Now()->minute;
            $minutes = $time[0]*60 + $time[1] ;
            $j = Slot::convertTimeIntoSlots($minutes);

            $freeTechniciansIds = [];
            $startIndexSlot = 0;
            $timeDelivery = null;
            $trovatoTutto = false;


            $syncTable->setScanIndex($j);
            $syncTable->save();
            while ($trovatoTutto == false && $j < $sizeOfDiary) {

                $trovato = false;
                while ($j < $sizeOfDiary && $trovato == false) {

                    $freeDronesIds = $droneCollection->getFreeResources($j);
                    $freePilotsIds = $pilotCollection->getFreeResources($j);


                    $listResources = $syncTable->updateSyncTable($freeDronesIds, $freePilotsIds);

                    if(count($listResources)>0 && $listResources[2] == $journeySlots)
                    {
                        $trovato = true;

                        if (count($listResources) != 0) {
                            $freeTechniciansIds = $technicianCollection->getFreeResources($j-$journeySlots +1);
                        }

                        if (count($listResources) != 0 && count($freeTechniciansIds) != 0) {


                            $idDrone = $listResources[0];
                            $idPilot = $listResources[1];
                            $idTechnician = $freeTechniciansIds[0];

                            $syncTable->setFindTechnicianIndex($idTechnician->id);
                            $syncTable->save();


                            $state = 'reserved';
                            $startIndexSlot = $j - $journeySlots + 1;

                            $droneCollection->setState($idDrone, $startIndexSlot, $journeySlots, $state);
                            $pilotCollection->setState($idPilot, $startIndexSlot, $journeySlots, $state);
                            $technicianCollection->setState($idTechnician->id, $startIndexSlot, 1, $state);



                            //corrisponde allo slot finale, cioè l'orario di arrivo dell'ordine
                            $slotNumber = $j;
                            $timeDelivery = Slot::convertSlotsInTime($slotNumber);
                            array_push($timeDeliveryArray, $timeDelivery);
                            $trovatoTutto = true;
                        }

                    }

                    $syncTable->setScanIndex($j-1);
                    $syncTable->save();
                    $j++;
                }

            }
        }

        return $timeDeliveryArray;
    }

    public function confirmedOrder(){
        $carrier = $this->transportOrder->carrier;
        $droneCollection = new DronesCollection();
        $pilotCollection = new PilotsCollection();
        $technicianCollection = new TechniciansCollection();

        $state = 'busy';
        foreach ($carrier as $carri){
            $syncTable = $carri->syncTable;
            $startIndexSlot = ($syncTable->scanIndex)-($syncTable->journey_slots)+1;
            $droneCollection->setState($syncTable->findDronIndex, $startIndexSlot+1, $syncTable->journey_slots, $state);
            $pilotCollection->setState($syncTable->findPilotIndex, $startIndexSlot+1, $syncTable->journey_slots, $state);
            $technicianCollection->setState($syncTable->findTechnicianIndex, $startIndexSlot+1, 1, $state);
        }
    }

	public function cancelOrder(){
		$carrier = $this->transportOrder->carrier;
        $droneCollection = new DronesCollection();
        $pilotCollection = new PilotsCollection();
        $technicianCollection = new TechniciansCollection();

        $state = 'free';
        foreach ($carrier as $carri){
            $syncTable = $carri->syncTable;
            $startIndexSlot = ($syncTable->scanIndex)-($syncTable->journey_slots)+1;
            $droneCollection->setState($syncTable->findDronIndex, $startIndexSlot+1, $syncTable->journey_slots, $state);
            $pilotCollection->setState($syncTable->findPilotIndex, $startIndexSlot+1, $syncTable->journey_slots, $state);
            $technicianCollection->setState($syncTable->findTechnicianIndex, $startIndexSlot+1, 1, $state);
        }
	}
}
