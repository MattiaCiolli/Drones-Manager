<?php

namespace App\Services;

use App\Models\Address;

class OrderService
{
    public function parseAddress($jsonAddress)
	{
		$address = new Address($jsonAddress->address, $jsonAddress->lat, $jsonAddress->lon, $jsonAddress->srid);

	}
}
