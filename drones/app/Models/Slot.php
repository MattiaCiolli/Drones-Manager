<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table = 'slots';

    public function diary()
    {
        return $this->belongsTo('App\Models\Diary');
    }

    public function setDiary($diary)
    {
        $this->diary()->associate($diary);
    }

    public function convertTimeIntoSlots($journeyTime)
    {
        return ceil($journeyTime/15);
    }

    public function slotFree()
    {

    }

    public function reserve()
    {

    }

    public function convertSlotsInTime($slotNumber)
    {

    }
}
