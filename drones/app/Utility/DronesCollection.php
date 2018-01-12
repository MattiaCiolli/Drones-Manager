<?php
/**
 * Created by PhpStorm.
 * User: Giovanna
 * Date: 11/01/2018
 * Time: 14:46
 */

namespace App\Utility;


class DronesCollection extends ResourcesCollection
{
    public function getFreeResources($indexSlot)
    {
        $drones = \App\Models\Resource::where('type', 'drone');

        foreach ($drones as &$d)
        {
            
        }

    }
}