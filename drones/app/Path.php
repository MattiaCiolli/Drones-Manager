<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    public function path()
    {
        return $this->hasMany( Address::class);
    }
}
