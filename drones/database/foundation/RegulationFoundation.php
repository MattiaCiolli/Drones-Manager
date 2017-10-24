<?php

namespace database\foundation;

use App\Models\Address;
use Illuminate\Support\Facades\DB;
use database\foundation\InterfaceFoundation;

class RegulationFoundation implements InterfaceFoundation
{
	public function checkAddressCoordinates($lat, $lon)
	{
		return DB::select('select checkAddressCoordinates(?, ?);', [$lat, $lon]);
	}

	public function checkPathRoute($geom)
	{
		return DB::select('select checkPathRoute(ST_GeomFromText(st_astext(?), 3857));', [$geom]);
	}
}
