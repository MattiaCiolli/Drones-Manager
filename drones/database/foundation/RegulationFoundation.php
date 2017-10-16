<?php

namespace database\foundation;

use App\Models\Address;
use Illuminate\Support\Facades\DB;

class RegulationFoundation implements InterfaceFoundation
{
	public function checkAddress(Address $address)
	{
		return $address;
	}
}
