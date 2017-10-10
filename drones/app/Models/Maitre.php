<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Maitre extends Model
{
	private $name;
	private $surname;

	public function orderTransport()
	{
		return $this->hasMany(OrderTransport::class);
	}

	public function entTransport()
	{
		return $this->belongsTo(EnterpriseTransport::class);
	}
	
	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getSurname()
	{
		return $this->surname;
	}

	public function setSurname($surname)
	{
		$this->surname = $surname;
	}
}
