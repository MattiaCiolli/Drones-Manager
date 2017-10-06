<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MaitreTransport;
use App\EnterpriseTransport;

class OrderTransport extends Model
{
	private $maitreTransport;
	private $enterpriseTransport;

    public function entTransport()
    {
        $this->enterpriseTransport = $this->belongsTo(EnterpriseTransport::class);
    }

    public function maitreTransport()
    {
        $this->maitreTransport =  $this->belongsTo(MaitreTransport::class);
    }
}
