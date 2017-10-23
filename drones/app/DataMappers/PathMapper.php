<?php

namespace App\DataMappers;

use database\foundation\InterfaceFoundation;

use App\DataMappers\PathMapper;
use database\foundation\PathFoundation;
use App\Models\Path;

class PathMapper
{
	private $foundation;

	public function __construct(InterfaceFoundation $interfaceFoundation)
	{
	   $this->foundation = $interfaceFoundation;
	}

	public function generatePathGeometry($lat1, $lon1, $lat2, $lon2, $lat3, $lon3)
	{
		$result = $this->foundation->triangulate($lat1, $lon1, $lat2, $lon2, $lat3, $lon3);
		return $result;
	}
}
