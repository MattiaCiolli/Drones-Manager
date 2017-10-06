<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    public function addresses()
    {
        return $this->hasMany( Address::class);
    }

    public function ordTransport()
    {
        return $this->belongsTo( OrderTransport::class);
    }
}
