<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
