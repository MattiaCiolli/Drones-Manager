<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnterpriseTransport extends Model
{
    public function maitreTransport()
    {
        return $this->hasMany(MaitreTransport::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function ordTransport()
    {
        return $this->hasMany(OrderTransport::class);
    }
}
