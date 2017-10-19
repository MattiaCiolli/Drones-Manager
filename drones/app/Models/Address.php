<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	private $address;
	private $lat;
	private $lon;
	private $srid;

	function __construct($address, $lat, $lon, $srid)
	{
		$this->address = $address;
		$this->lat = $lat;
		$this->lon = $lon;
		$this->srid = $srid;
  	}

	public function setSrid($srid)
	{
		$this->$srid = $srid;
	}

	public function getSrid()
	{
		return $this->srid;
	}

	public function setLatitudine($lat)
	{
		$this->lat = $lat;
	}

	public function getLatitudine()
	{
		return $this->lat;
	}

	public function setLongitudine($lon)
	{
		$this->lon = $lon;
	}

	public function getLongitudine()
	{
		return $this->lon;
	}

	public function setStringAddress($address)
	{
		$this->$address = $address;
	}

	public function getStringAddress()
	{
		return $this->address;
	}

	public function setCoordinates($lat, $lon)
	{
		$this->$lat = $lat;
		$this->$lon = $lon;
	}
}
