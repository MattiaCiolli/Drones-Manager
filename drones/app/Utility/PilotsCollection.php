<?php
/**
 * Created by PhpStorm.
 * User: Giovanna
 * Date: 11/01/2018
 * Time: 14:47
 */

namespace App\Utility;


class PilotsCollection extends ResourcesCollection
{
    public function getFreeResources($slot)
    {
        $pilotsList = \App\Models\Resource::where('type', 'pilot');
        return $pilotsList;
    }
}