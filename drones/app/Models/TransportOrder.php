<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportOrder extends Order
{
	public function entTransport()
	{
		$this->enterpriseTransport = $this->belongsTo(EnterpriseTransport::class);
	}

	public function maitreTransport()
	{
		$this->maitreTransport =  $this->belongsTo(MaitreTransport::class);
	}
}
