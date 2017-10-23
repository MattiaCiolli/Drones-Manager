<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Enterprise extends Model
{
	private $address;
	private $maitre;

    public function setCatalog($catalog)
    {
        $this->catalog()->associate($catalog);
    }


    public function catalog()
    {
        return $this->belongsTo('App\Models\Catalog');
    }

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress(Address $address)
	{
		$this->address = $address;
	}

	public function getMaitre()
	{
		return $this->maitre;
	}

	public function setMaitre(Address $maitre)
	{
		$this->maitre = $maitre;
	}
}
