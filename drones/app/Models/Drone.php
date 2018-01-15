<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drone extends Resource
{
    protected $table = 'resources';

    public function isfree($slot){
        $idDrone = $this->diary->checkAvailability($slot);
        return $idDrone;
    }
}
