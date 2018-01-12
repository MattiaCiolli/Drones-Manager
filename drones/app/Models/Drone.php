<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Drone extends Resource
{
    protected $table = 'drones';

    public function isfree($slot){
        $idDrone = $this->diary->checkAvailability($slot);
        return $idDrone;
    }
}
