<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $table = 'diaries';

    public function slots()
    {
        return $this->hasMany('App\Models\Slot')->orderBy('index');
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
        for ($i=$startIndexSlot; $i < $startIndexSlot + $journeySlot; $i++){

            foreach ($slots as $s){
                if($s->index == $i){
                    if($s->state == "free") {
                        $s->state = $state;
                        $s->save();
                    }
                    if($s->state == "reserved") {
                        $s->state = $state;
                        $s->save();
                    }
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
