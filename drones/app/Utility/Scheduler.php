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
use Carbon\Carbon;
use Psy\Input\CodeArgument;

class Scheduler
{
    public function getTimeDelivery($journeySlots, $numCarriers, $orderId){

        $transportOrder = \App\Models\TransportOrder::find($orderId);
        $orderCarriers = $transportOrder->carrier;
        $timeDeliveryArray = [];
        foreach ($orderCarriers as $carrier){
        //for ($i = 0; $i< $numCarriers; $i++) {
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
                            $freeTechniciansIds = $technicianCollection->getFreeResources($j);
                        }

                        if (count($listResources) != 0 && count($freeTechniciansIds) != 0) {
                            $idDrone = $listResources[0];
                            $idPilot = $listResources[1];
                            $idTechnician = $freeTechniciansIds[0];

                            $syncTable->setFindTechnicianIndex($idTechnician->id);
                            $syncTable->save();

                            $state = 'reserved';
                            $startIndexSlot = $j - $journeySlots;

                            $droneCollection->setState($idDrone, $startIndexSlot, $journeySlots, $state, $orderId);
                            $pilotCollection->setState($idPilot, $startIndexSlot, $journeySlots, $state, $orderId);
                            $technicianCollection->setState($idTechnician->id, $startIndexSlot, 1, $state, $orderId);

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


}