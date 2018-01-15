<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $table = 'diaries';

    public function slots()
    {
        return $this->hasMany('App\Models\Slot');
    }

    public function setSlots($slots)
    {
        $this->slots()->associate($slots);
    }

    public function resource()
    {
        return $this->belongsTo('App\Models\Resource');
    }

    public function getDiary()
    {

    }

    public function setStateSlot($startIndexSlot, $journeySlot, $state)
    {

    }

    public function checkAvailability($slot)
    {
        $slots = $this->slots;
        //dd($slot);

        $state = $slots[$slot]->state;
        return $state;
    }
}
