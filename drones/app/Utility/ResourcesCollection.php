<?php
/**
 * Created by PhpStorm.
 * User: Giovanna
 * Date: 11/01/2018
 * Time: 14:42
 */

namespace App\Utility;


abstract class ResourcesCollection
{
    public function reserve($idResource, $startIndexSlot, $journeySlot){

    }
    public function getFreeResources($slot){
        $idPilots = [];
        return $idPilots;
    }
}