<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Path;

use App\DataMappers\PathMapper;
use database\foundation\PathFoundation;

class PathService
{
	public function generatePath(Address $destination, Address $enterprise, Address $hangar)
	{
		$pathFoundation = new PathFoundation();
		$pathMapper = new PathMapper($pathFoundation);
		return $pathMapper->generatePathGeometry($destination->getLatitudine(), $destination->getLongitudine(), $enterprise->getLatitudine(), $enterprise->getLongitudine(), $hangar->getLatitudine(), $hangar->getLongitudine());
	}
}
