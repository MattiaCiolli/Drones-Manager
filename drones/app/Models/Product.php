<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    public function description()
    {
        return $this->belongsTo('App\Models\ProductDescription');
    }

    public function carrier()
    {
        return $this->belongsTo('App\Models\Carrier');
    }

    public function setDescription($description)
    {
        $this->description()->associate($description);
    }

    public function setCarrier($carrier)
    {
        $this->carrier()->associate($carrier);
    }

}
