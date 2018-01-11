<?php

namespace App\Models;

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
}
