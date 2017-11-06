<?php

namespace App\DataMappers;

use database\foundation\InterfaceFoundation;


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
		$path = $this->foundation->triangulate($lat1, $lon1, $lat2, $lon2, $lat3, $lon3);
		$pathLength = $this->calculateGeometryLength($path[0]->generatepath);
		return new Path(['path_geometry' => $path[0]->generatepath, 'path_length' => $pathLength[0]->st_length]);
	}

	public function calculateGeometryLength($geometry)
	{
		return $this->foundation->calculateLength($geometry);
	}
}
