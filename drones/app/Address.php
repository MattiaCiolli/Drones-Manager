<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function path()
    {
        return $this->belongsTo(Path::class);
    }

    public function orderTransport()
    {
        return $this->belongsTo(OrderTransport::class);
    }
}
