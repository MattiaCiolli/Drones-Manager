<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalogs';

    public function descriptionProduct()
    {
        return $this->hasMany('App\Models\ProductDescription');
    }

    public function enterprise()
    {
        return $this->hasOne('App\Models\TransportEnterprise');
    }
}
