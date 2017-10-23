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
        $this->maitre()->associate($price);
    }

	public function address()
	{
		return $this->belongsTo('App\Models\Address');
	}

	public function maitre()
	{
		return $this->belongsTo('App\Models\TransportMaitre');
	}

    public function carrier()
    {
        return $this->hasMany('App\Models\Carrier');
    }

    public function price()
    {
        return $this->hasOne('App\Models\Price');
    }
}
