<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $table = 'slots';
    //private $state;


    public function diary()
    {
        return $this->belongsTo('App\Models\Diary');
    }

    public function transportOrder()
    {
        return $this->belongsTo('App\Models\TransportOrder');
    }

    public function setDiary($diary)
    {
        $this->diary()->associate($diary);
    }

    public static function convertTimeIntoSlots($journeyTime)
    {
        return ceil($journeyTime/15);
    }

    public function slotFree()
    {
        return $this->state;
    }

    public function setState($state)
    {

    }

    public static function convertSlotsInTime($slotNumber)
    {
        $minTot = $slotNumber * config('slot.size');
        $hour = floor($minTot / 60);
        $min = $minTot % 60;
        if($hour<10){
            $hour = "0".$hour;
        }
        if($min<10){
            $min = "0".$min;
        }
        $arrivalTime = "$hour:$min";
        return $arrivalTime;

    }
}
