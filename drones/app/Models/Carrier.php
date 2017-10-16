<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function transportOrder()
    {
        return $this->belongsTo('App\Models\TransportOrder');
    }

    public function setTransportOrder($order){
        $this->transportOrder()->associate($order);
    }

}
