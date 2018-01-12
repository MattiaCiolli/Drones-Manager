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
    private $freeDronesIds = [];    //array di oggetti
    private $freePilotsIds = [];
    private $journeySlots;
    private $matrice;
    private $count = 0;      //è la variabile che si incrementa all'interno della matrice
    public function __construct($freeDronesIds, $freePilotsIds, $journeySlots)
    {
        $this->freeDronesIds = $freeDronesIds;
        $this->freePilotsIds = $freePilotsIds;
        $this->journeySlots = $journeySlots;
        foreach ($this->freeDronesIds as $drone){
            foreach ($this->freePilotsIds as $pilot){
                $this->matrice[$drone->id][$pilot->id] = 0; // oppure [False, 0]; ???
            }
        }
    }

    public function updateSyncTable($freeDronesIds, $freePilotsIds){

        foreach ($freeDronesIds as $drone){
            foreach ($freePilotsIds as $pilot){
                if ($drone->state == $pilot->state ){
                    $this->matrice[$drone->id][$pilot->id] = $this->count + 1;
                }else{
                    $this->matrice[$drone->id][$pilot->id] = 0;
                }
            }
        }
        $listResources = $this->checkReachability();

        return $listResources;
    }

    public function checkReachability(){
        $listResources = [];
        foreach ($this->freeDronesIds as $drone) {
            foreach ($this->freePilotsIds as $pilot) {
                if ($this->matrice[$drone->id][$pilot->id] = $this->journeySlots){
                    $listResources = array($drone->id, $pilot->id);
                    return $listResources;
                }
            }
        }
        return$listResources;

    }

    public function getSyncTable($idOrder){
        $syncTable = [];
        return $syncTable;
    }
}