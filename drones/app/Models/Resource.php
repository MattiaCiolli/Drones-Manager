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
        return $this->hasOne('App\Models\Diary');
    }

    public function setDiary($diary)
    {
        $this->diary()->associate($diary);
    }

    public function isFree($slotIndex)
    {
        $idDrone = 0; //add qualcosa
        return $idDrone;
    }

    public function reserve($idResource, $startIndexSlot, $journeySlot){

    }
}
