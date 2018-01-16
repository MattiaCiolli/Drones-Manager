<?php
/**
 * Created by PhpStorm.
 * User: Giovanna
 * Date: 11/01/2018
 * Time: 14:47
 */

namespace App\Utility;


class TechniciansCollection extends ResourcesCollection
{
    public function getFreeResources($slot)
    {
        $freeTechList = [];
        $techList = \App\Models\Technician::where('type', 'technician')->get();
        foreach ($techList as $tech){
            $stateTech = $tech->isFree($slot);
            if ($stateTech == 'free'){
                array_push($freeTechList,$tech);
            }
        }
        return $freeTechList;
    }

    public function setState($idResource, $startIndexSlot, $journeySlot, $state)
    {
        $resource = \App\Models\Technician::where('id',$idResource)->first();
        //dd($journeySlot);
        $resource->setState($startIndexSlot, $journeySlot, $state);
    }
}