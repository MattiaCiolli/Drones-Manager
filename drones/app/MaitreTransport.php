<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaitreTransport extends Model
{
    public function ordertransport()
    {
        return $this->belongsTo(OrderTransport::class);
    }
}
