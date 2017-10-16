<?php

namespace App\Services;

use App\Models\Address;

class AddressService
{
    public function parseAddress($jsonAddress)
	{
		$address = new Address($jsonAddress->address, $jsonAddress->lat, $jsonAddress->lon, $jsonAddress->srid);
	}
}
