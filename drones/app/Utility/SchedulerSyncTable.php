<?php
/**
 * Created by PhpStorm.
 * User: Giovanna
 * Date: 11/01/2018
 * Time: 15:54
 */

namespace App\Utility;


class SchedulerSyncTable
{
    private $dronesIds = [];    //array di oggetti
    private $pilotsIds = [];
    private $journeySlots;
    private $matrice;
    private $count = 0;      //è la variabile che si incrementa all'interno della matrice
    public function __construct($dronesIds, $pilotsIds, $journeySlots)
    {
        $this->dronesIds = $dronesIds;
        $this->pilotsIds = $pilotsIds;
        $this->journeySlots = $journeySlots;
        foreach ($this->dronesIds as $drone){
            foreach ($this->pilotsIds as $pilot){
                $this->matrice[$drone->id][$pilot->id] = 0; // oppure [False, 0]; ???
            }
        }
    }

    public function updateSyncTable($freeDrones, $freePilots){

        $freeDronesIds = [];
        for ($i = 0; $i < count($freeDrones); $i++){
            array_push($freeDronesIds, (string)$freeDrones[$i]->id);
        }

        $freePilotsIds = [];
        for ($i = 0; $i < count($freePilots); $i++){
            array_push($freePilotsIds, (string)$freePilots[$i]->id);
        }

        foreach ($this->dronesIds as $drone){
            foreach ($this->pilotsIds as $pilot){
                if (in_array($drone->id, $freeDronesIds) && in_array($pilot->id, $freePilotsIds) ){
                    $this->matrice[$drone->id][$pilot->id]++;
                }else{
                    $this->matrice[$drone->id][$pilot->id] = 0;
                }
            }
        }


        $listResources = $this->checkReachability();

        return $listResources;
    }

    public function checkReachability(){
        //$listResources = [0, 0, 0];
        $listResources = [];
        foreach ($this->dronesIds as $drone) {
            foreach ($this->pilotsIds as $pilot) {
                if ($this->matrice[$drone->id][$pilot->id] == $this->journeySlots){
                    $listResources = array($drone->id, $pilot->id, $this->matrice[$drone->id][$pilot->id]);
                    return $listResources;
                }
            }
        }

        return $listResources;

    }

    public function getSyncTable($idOrder){
        return $this->matrice;
    }
}