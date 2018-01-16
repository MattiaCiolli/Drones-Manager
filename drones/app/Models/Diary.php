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
        $slots = $this->slots;
        for ($i=$startIndexSlot; $i < $journeySlot; $i++){
            //dd($this->slots[$i]);
            foreach ($slots as $s){
                if($s->index == $i){
                    $s->state = $state;
                }
            }

        }
    }

    public function checkAvailability($slotIndex)
    {
        $slots = $this->slots;
        foreach ($slots as $s)
        {
            if($s->index == $slotIndex)
            {
                $state = $s->state;
            }
        }

        return $state;
    }
}
