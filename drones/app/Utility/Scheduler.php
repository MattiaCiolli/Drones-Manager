<?php
/**
 * Created by PhpStorm.
 * User: Giovanna
 * Date: 12/01/2018
 * Time: 11:06
 */

namespace App\Utility;


use App\Models\Slot;

class Scheduler
{
    public function getTimeDelivery($journeySlots, $numCarriers, $orderId){

        $timeDeliveryArray = [];
        for ($i = 0; $i< $numCarriers; $i++) {
            $dronesList = \App\Models\Drone::select('id')->where('type', 'drone')->get();
            //dd(typeOf($dronesList));
            $pilotsList = \App\Models\Pilot::select('id')->where('type', 'pilot')->get();
            $journeySlots = (int)$journeySlots;
            $schedulerSyncTable = new SchedulerSyncTable($dronesList, $pilotsList, $journeySlots);
            $sizeOfDiary = config('slot.numberInADay');
            $droneCollection = new DronesCollection();
            $pilotCollection = new PilotsCollection();
            $technicianCollection = new TechniciansCollection();
            $timeDelivery = [];
            $listResources = [];
            //cambiare l'indice di partenza in base all'orario in cui viene fatto l'ordine
            $j = 0;
            $freeDronesIds = [];   //collezione di oggetti
            $freePilotsIds = [];
            $freeTechniciansIds = [];
            $startIndexSlot = 0;
            $timeDelivery = null;
            $trovatoTutto = false;
            while ($trovatoTutto == false && $j < $sizeOfDiary) {

                $trovato = false;
                while ($j < $sizeOfDiary && $trovato == false) {

                    $freeDronesIds = $droneCollection->getFreeResources($j);
                    $freePilotsIds = $pilotCollection->getFreeResources($j);
                    $listResources = $schedulerSyncTable->updateSyncTable($freeDronesIds, $freePilotsIds);

                    /*
                    if(count($freeDronesIds)>0 && count($freePilotsIds)>0) {
                        $listResources = $schedulerSyncTable->updateSyncTable($freeDronesIds, $freePilotsIds);
                    }*/

                    if(count($listResources)>0 && $listResources[2] == $journeySlots)
                    {
                        $trovato = true;

                        if (count($listResources) != 0) {
                            $freeTechniciansIds = $technicianCollection->getFreeResources($j);
                        }

                        if (count($listResources) != 0 && count($freeTechniciansIds) != 0) {
                            //dd($listResources);
                            $idDrone = $listResources[0];
                            $idPilot = $listResources[1];
                            $idTechnician = $freeTechniciansIds[0];
                            $state = 'reserved';
                            $startIndexSlot = $j - $journeySlots;

                            $droneCollection->setState($idDrone, $startIndexSlot, $journeySlots, $state, $orderId);
                            $pilotCollection->setState($idPilot, $startIndexSlot, $journeySlots, $state, $orderId);
                            $technicianCollection->setState($idTechnician->id, $startIndexSlot, $journeySlots, $state, $orderId);

                            $slot = new Slot();
                            //corrisponde allo slot finale, cioè l'orario di arrivo dell'ordine
                            $slotNumber = $j;
                            $timeDelivery = $slot->convertSlotsInTime($slotNumber);
                            array_push($timeDeliveryArray, $timeDelivery);
                            $trovatoTutto = true;
                        }

                    }

                    $j++;
                }

            }
        }

        return $timeDeliveryArray;
    }

    public function confirmOrder($idOrder){
        $state='busy';

    }

}