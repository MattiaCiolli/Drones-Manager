<?php

namespace database\foundation;

use Illuminate\Support\Facades\DB;
use database\foundation\InterfaceFoundation;

class PathFoundation implements InterfaceFoundation
{
	public function triangulate($lat1, $lon1, $lat2, $lon2, $lat3, $lon3)
	{
		return DB::select('select  generatePath(?, ?, ?, ?, ?, ?);', [$lat1, $lon1, $lat2, $lon2, $lat3, $lon3]);
	}

	public function calculateLength($geometry)
	{
		return DB::select('select st_length(?)', [$geometry]);
	}
}
