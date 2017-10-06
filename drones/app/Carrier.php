<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orderTransport()
    {
        return $this->belongsTo(OrderTransport::class);
    }
}
