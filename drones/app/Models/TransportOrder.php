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
        $this->price()->associate($price);
    }

	public function setPath($path)
	{
		$this->path()->associate($path);
	}

	public function setAddress($address)
	{
		$this->address()->associate($address);
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
        return $this->belongsTo('App\Models\Price');
    }

	public function path()
	{
		return $this->belongsTo('App\Models\Path');
	}

    public function getNumCarriers()
    {
        $car = $this->carrier();
        $i=0;
        foreach ($car as &$c)
        {
            $i++;
        }
        return $i;
    }
}
