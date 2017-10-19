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
}
