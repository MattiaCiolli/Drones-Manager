<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTransport extends Model
{
    public function carriers()
    {
        return $this->hasMany(Carrier::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function path()
    {
        return $this->hasOne(Path::class);
    }

    public function entTransport()
    {
        return $this->belongsTo(EnterpriseTransport::class);
    }

    public function maitreTransport()
    {
        return $this->hasOne(MaitreTransport::class);
    }

    public function price()
    {
        return $this->hasOne(Price::class);
    }
}
