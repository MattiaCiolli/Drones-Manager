<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTransport extends Model
{
    public function products()
    {
        return $this->hasMany(Carrier::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function enterpriseTransport()
    {
        return $this->hasOne(EnterpriseTransport::class);
    }

    public function maitreTransport()
    {
        return $this->hasOne(MaitreTransport::class);
    }
}
