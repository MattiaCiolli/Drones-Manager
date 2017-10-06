<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaitreTransport extends Model
{
    public function orderTransport()
    {
        return $this->belongsTo(OrderTransport::class);
    }

    public function entTransport()
    {
        return $this->belongsTo(EnterpriseTransport::class);
    }
}
