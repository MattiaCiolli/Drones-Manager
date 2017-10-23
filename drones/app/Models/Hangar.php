<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hangar extends Model
{
	public function address()
	{
		return $this->belongsTo(Address::class);
	}
}
