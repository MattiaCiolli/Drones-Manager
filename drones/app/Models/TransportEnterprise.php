<?php

namespace App\Models;

class TransportEnterprise extends Enterprise
{
    protected $table = 'transports_enterprises';

	public function address()
	{
		return $this->belongsTo('App\Models\Address');
	}

	public function hangar()
	{
		return $this->belongsTo('App\Models\Hangar');
	}
}
