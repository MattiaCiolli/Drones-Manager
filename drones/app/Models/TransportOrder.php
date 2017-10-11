<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportOrder extends Order
{
	protected $table = 'transports_orders';
	protected $fillable = ['maitre_id'];

	private $maitre_id;

	public function setIdMaitre($maitreId)
	{
		$this->maitre_id = $maitreId;
	}

	public function maitre()
	{
		return $this->hasOne('App\MaitreTransport');
	}

}
