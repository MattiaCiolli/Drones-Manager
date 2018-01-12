<?php

namespace App\Http\Controllers;

use App\Models\TransportOrder;
use App\Slot;
use App\Utility\Scheduler;
use Illuminate\Http\Request;

class SchedulerController extends Controller
{
    public function getTimeDelivery(){
        $idOrder = 1;  //????
        $transportOrder = new TransportOrder();
        $transportOrder = \App\Models\TransportOrder::find($idOrder);
        $path = $transportOrder->path_id;
        $path = \App\Models\Path::find($path);
        $journeyTime = $path->getJourneyTime();
        $slot = new Slot();
        $journeySlots = $slot->convertTimeIntoSlots($journeyTime);
        $numCarriers = $transportOrder->getNumCarriers();
        $scheduler = new Scheduler();
        $timeDelivery = $scheduler->getTimeDelivery($journeySlots, $numCarriers);
        return view('confirm', $timeDelivery);
        //return $arrayListTime;
    }


}
