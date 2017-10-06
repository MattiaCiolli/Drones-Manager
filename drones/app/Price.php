<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public function ordTransport()
    {
        return $this->belongsTo(OrderTransport::class);
    }

    public function currency()
    {
        return $this->hasOne(Currency::class);
    }
}
