<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyncTable extends Model
{

    protected $table = 'sync_tables';
    protected $fillable = ['matrice', 'scanIndex', 'journey_slots'];


    private $matrice;
    private $scanIndex;
    private $journey_slots;

    public function inizializzaSyncTable($dronesIds, $pilotsIds, $journeySlots)
    {
        foreach ($dronesIds as $drone){
            foreach ($pilotsIds as $pilot){
                $this->matrice[$drone->id][$pilot->id] = 0; // oppure [False, 0]; ???
            }
        }
        $this->journey_slots=$journeySlots;
        $this->setJourneySlots($journeySlots);
        $this->setScanIndex(0);
        $this->setMatrice(serialize($this->matrice));
        $this->save();

        //$this->fresh();
        //dd('ciao'.$this->getJourneySlots());
    }


    public function updateSyncTable($freeDrones, $freePilots)
    {

        $freeDronesIds = [];
        for ($i = 0; $i < count($freeDrones); $i++) {
            array_push($freeDronesIds, (string)$freeDrones[$i]->id);
        }
        $freePilotsIds = [];
        for ($i = 0; $i < count($freePilots); $i++) {
            array_push($freePilotsIds, (string)$freePilots[$i]->id);
        }

        $idsDronesMatrix=[];
        $idsPilotsMatrix=[];
        foreach($this->matrice as $key=>$value){
            array_push($idsDronesMatrix, $key);
        }
        foreach(reset($this->matrice) as $key=>$value){
            array_push($idsPilotsMatrix, $key);
        }


        foreach ($idsDronesMatrix as $drone) {
            foreach ($idsPilotsMatrix as $pilot) {
                if (in_array($drone, $freeDronesIds) && in_array($pilot, $freePilotsIds)) {
                    $this->matrice[$drone][$pilot]++;
                } else {
                    $this->matrice[$drone][$pilot] = 0;
                }
            }
        }

        $listResources = $this->checkReachability($idsDronesMatrix, $idsPilotsMatrix);

        return $listResources;
    }

    public function checkReachability($idsDronesMatrix, $idsPilotsMatrix){
        $listResources = [];
        foreach ($idsDronesMatrix as $drone) {
            foreach ($idsPilotsMatrix as $pilot) {
                if ($this->matrice[$drone][$pilot] == $this->journey_slots){
                    $listResources = array($drone, $pilot, $this->matrice[$drone][$pilot]);

                    return $listResources;
                }

            }
        }
        return $listResources;
    }

    public function carrier()
    {
        return $this->hasOne('App\Models\Carrier');
    }

    public function setJourneySlots($journey_slots)
    {
        $this->fill(['journey_slots' => $journey_slots]);
    }

    public function setMatrice($matrice)
    {
        $this->fill(['matrice' => $matrice]);
    }

    public function setScanIndex($scanIndex)
    {
        $this->fill(['scanIndex' => $scanIndex]);
    }

    public function getJourneySlots(){
        return $this->journey_slots;
    }
}
