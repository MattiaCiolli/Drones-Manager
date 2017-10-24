<?php

namespace App\DataMappers;

use database\foundation\InterfaceFoundation;
use App\Models\Address;

class RegulationMapper
{
	private $foundation;

	public function __construct(InterfaceFoundation $interfaceFoundation)
	{
	   $this->foundation = $interfaceFoundation;
	}

	public function checkAddress(Address $address)
	{
		$result = $this->foundation->checkAddressCoordinates($address->getLatitudine(), $address->getLongitudine());
		return $result[0]->checkaddresscoordinates;
	}

	public function checkPath($geomtry)
	{
		$result = $this->foundation->checkPathRoute($geomtry);
		return $result[0]->checkpathroute;
	}
}
