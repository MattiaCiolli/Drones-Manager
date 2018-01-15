<?php
/**
 * Created by PhpStorm.
 * User: Giovanna
 * Date: 12/01/2018
 * Time: 11:06
 */

namespace App\Utility;


use App\Slot;

class Scheduler
{
    public function getTimeDelivery($journeySlots, $numCarriers){
        for ($i = 0; $i< count($numCarriers); $i++){
            $dronesList = \App\Models\Drone::select('id')->where('type', 'drone');
            $pilotesList = \App\Models\Pilot::select('id')->where('type', 'pilot');
            foreach ($dronesList as $i){
                dd($dronesList);
            }

            $schedulerSyncTable = new SchedulerSyncTable( $dronesList, $pilotesList, $journeySlots);
            $sizeOfDiary = config('slot.numberInADay');
            $droneCollection = new DronesCollection();
            $pilotCollection = new PilotsCollection();
            $technicianCollection = new TechniciansCollection();
            $timeDelivery = [];
            $listResources = [];
            //cambiare l'indice di partenza in base all'orario in cui viene fatto l'ordine
            $j = 0;
            while($j<$sizeOfDiary || $listResources != []) {
                $freeDronesIds = [];   //collezione di oggetti
                $freePilotsIds = [];

                $freeDronesIds = $droneCollection->getFreeResources($j);    //ritorna tutti gli oggetti
                $freePilotsIds = $pilotCollection->getFreeResources($j);
                $listResources = $schedulerSyncTable->updateSyncTable($freeDronesIds, $freePilotsIds);

                $j++;
            }
            if ($listResources != []){
                $startIndexSlot = $j - $journeySlots;
                $freeTechniciansIds = $technicianCollection->getFreeResources($startIndexSlot);
            }

            if($listResources != [] && $freeTechniciansIds != []){
                $idDrone = $listResources[0];
                $idPilot = $listResources[1];
                $idTechnician = $freeTechniciansIds[0];
                $state = 'reserved';
                $droneCollection->setState($idDrone, $startIndexSlot, $journeySlots, $state);
                $pilotCollection->setState($idPilot, $startIndexSlot, $journeySlots, $state);
                $technicianCollection->setState($idTechnician, $startIndexSlot, $journeySlots, $state);
            }

            $slot = new Slot();
            //corrisponde allo slot finale, cioè l'orario di arrivo dell'ordine
            $slotNumber = $j;
            $timeDelivery = $slot->convertSlotsInTime($slotNumber);
        }

        return $timeDelivery;
    }

}