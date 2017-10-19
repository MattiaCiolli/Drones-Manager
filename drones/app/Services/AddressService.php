<?php

namespace App\Services;

use App\Models\Address;
use App\DataMappers\RegulationMapper;
use database\foundation\RegulationFoundation;

class AddressService
{
    public function parseAddress($jsonAddress)
	{
		return new Address($jsonAddress->address, $jsonAddress->lat, $jsonAddress->lon, 4326);
	}

	public function checkAddress($address)
	{
		$regulationFoundation = new RegulationFoundation();
		$regulationMapper = new RegulationMapper($regulationFoundation);
		return $regulationMapper->checkAddress($address);
	}
}
