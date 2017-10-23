<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Maitre extends Model
{
	private $name;
	private $surname;

	public function orderTransport()
	{
		return $this->hasMany('App\Models\TransportOrder');
	}

	public function enterprise()
	{
		return $this->belongsTo('App\Models\TransportEnterprise');
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
