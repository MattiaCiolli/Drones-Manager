<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $table = 'carriers';
    protected $fillable = ['free_slots'];

    private $free_slots;


    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function transportOrder()
    {
        return $this->belongsTo('App\Models\TransportOrder');
    }

    public function setTransportOrder($order)
    {
        $this->transportOrder()->associate($order);
    }

    public function getFreeSlots()
    {
        return $this->free_slots;
    }

    public function setFreeSlots($freeSlots)
    {
        $this->fill(['free_slots' => $freeSlots]);
        //$this->free_slots = $freeSlots;
    }

}
