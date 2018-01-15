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
        foreach ($this->dronesIds as $drone){
            foreach ($this->pilotsIds as $pilot){
                if (in_array($drone,$freeDrones) && in_array($pilot,$freePilots) ){
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
        foreach ($this->dronesIds as $drone) {
            foreach ($this->pilotsIds as $pilot) {
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