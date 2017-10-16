<?php

namespace App\Models;

class TransportOrder extends Order
{
	protected $table = 'transports_orders';
	protected $fillable = ['maitre_id'];

	public function setMaitre($maitre)
	{
		$this->maitre()->associate($maitre);
	}

    public function setPrice($price)
    {
        $this->maitre()->associate($maitre);
    }

	public function maitre()
	{
		return $this->belongsTo('App\Models\TransportMaitre');
	}

}
