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
        $dronesList = \App\Models\Drone::where('type', 'drone')->get();
        foreach ($dronesList as $drone){
            $stateDrone = $drone->isFree($slot);
            if ($stateDrone == 'free'){
                array_push($freeDronesList,$drone);
            }
        }
        return $freeDronesList;
    }

    public function setState($idResource, $startIndexSlot, $journeySlot, $state, $orderId)
    {
        $resource = \App\Models\Drone::where('id',$idResource)->first();
        //dd($journeySlot);
        $resource->setState($startIndexSlot, $journeySlot, $state, $orderId);
    }
}