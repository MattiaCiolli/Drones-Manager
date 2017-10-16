<?php

namespace App\DataMappers;

use database\foundation\InterfaceFoundation;

class RegulationMapper
{
	private $foundation;

	public function __construct(InterfaceFoundation $interfaceFoundation)
	{
	   $this->foundation = $interfaceFoundation;
	}
}
