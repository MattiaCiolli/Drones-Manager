<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Path;
use App\Services\Regulation;

use App\DataMappers\PathMapper;
use App\DataMappers\RegulationMapper;

use database\foundation\PathFoundation;
use database\foundation\RegulationFoundation;


class PathService
{
	public function generatePath(Address $destination, Address $enterprise, Address $hangar)
	{
		$pathFoundation = new PathFoundation();
		$pathMapper = new PathMapper($pathFoundation);
		$path = $pathMapper->generatePathGeometry($destination->getLatitudine(), $destination->getLongitudine(), $enterprise->getLatitudine(), $enterprise->getLongitudine(), $hangar->getLatitudine(), $hangar->getLongitudine());

		$regulationFoundation = new RegulationFoundation();
		$regulationMapper = new RegulationMapper($regulationFoundation);
		$isValid = $regulationMapper->checkPath($path->path_geometry);

		if($isValid)
			return $path;
		else
			return false;
	}
}
