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

    public function checkAvailability($indexSlot)
    {

    }

    public function reserveSlot($startIndexSlot, $journeySlot)
    {

    }
}
