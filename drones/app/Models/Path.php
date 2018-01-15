<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
	protected $fillable = ['path_geometry', 'path_length'];

    public function getJourneyTime()
    {
        return $this->path_length * 0.01;
    }

}
