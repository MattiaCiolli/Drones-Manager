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
    public function getFreeResources($slot)
    {
        $freeDronesList = [];
        $dronesList = \App\Models\Drone::where('type', 'drone');
        foreach ($dronesList as $drone){
            $stateDrone = $drone->isFree($slot);
            if ($stateDrone == 'free'){
                $freeDronesList = $drone;
            }
        }
        return $freeDronesList;
    }
}