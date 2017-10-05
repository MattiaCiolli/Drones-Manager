<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function description()
    {
        return $this->hasOne(ProductDescription::class);
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }
}
