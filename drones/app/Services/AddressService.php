<?php

namespace App\Services;

use App\Models\Address;
use App\DataMappers\RegulationMapper;
use database\foundation\RegulationFoundation;

class AddressService
{

    public function parseAddress($jsonAddress)
	{
		return new Address(['address' => $jsonAddress->indirizzo, 'lat' => $jsonAddress->coorLat, 'lon' => $jsonAddress->coorLng, 'srid' => 4326]);
	}

	public function checkAddress(Address $address)
	{
		$regulationFoundation = new RegulationFoundation();
		$regulationMapper = new RegulationMapper($regulationFoundation);
		return $regulationMapper->checkAddress($address);
	}
}
