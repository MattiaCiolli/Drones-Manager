<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TransportOrder extends Order
{
	protected $table = 'transports_orders';
	protected $fillable = ['maitre_id'];

	public function setMaitre($maitre)
	{
		$this->maitre()->associate($maitre);
	}

	public function maitre()
	{
		return $this->belongsTo('App\Models\TransportMaitre');
	}

}
