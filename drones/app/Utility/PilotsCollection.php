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

        $freePilotList = [];
        $pilotsList = \App\Models\Pilot::where('type', 'pilot')->get();
        foreach ($pilotsList as $pilot){
            $statePilot = $pilot->isFree($slot);
            if ($statePilot == 'free'){
                array_push($freePilotList,$pilot);
            }
        }
        return $freePilotList;
    }

}