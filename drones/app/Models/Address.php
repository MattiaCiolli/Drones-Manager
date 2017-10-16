<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	private $stringAddress;
	private $lat;
	private $lon;
	private $srid;

	function __construct($stringAddress, $lat, $lon, $srid)
	{
		$this->stringAddress = $stringAddress;
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

	public function setStringAddress($stringAddress)
	{
		$this->$stringAddress = $stringAddress;
	}

	public function getStringAddress()
	{
		return $this->stringAddress;
	}

	public function setCoordinates($lat, $lon)
	{
		$this->$lat = $lat;
		$this->$lon = $lon;
	}
}
