<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Resource extends Model
{
    private $id;
    private $diaryId;
    private $maxFreeConsSlots;

    public function diary()
    {
        return $this->hasOne('App\Models\Diary', 'resource_id');
    }

    public function setDiary($diary)
    {
        $this->diary()->associate($diary);
    }

    public function isFree($slotIndex)
    {
        $diary = $this->diary;
        $state = $diary->checkAvailability($slotIndex);

        return $state;
    }



    public function setState($startIndexSlot, $journeySlot, $state){
        $diary = $this->diary;
        $diary->setStateSlot($startIndexSlot, $journeySlot, $state);


    }
}
