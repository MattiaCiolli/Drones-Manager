<?php

namespace App\Http\Controllers;

use App\Models\TransportOrder;
use App\Slot;
use App\Utility\Scheduler;
use Illuminate\Http\Request;

class SchedulerController extends Controller
{
    public function getTimeDelivery($idOrder){
        $transportOrder = new TransportOrder();
        $transportOrder = \App\Models\TransportOrder::find($idOrder);
        $path = $transportOrder->path();
        $journeyTime = $path->getJourneyTime();
        $slot = new Slot();
        $journeySlots = $slot->convertTimeIntoSlots();
        $numCarriers = $transportOrder->getNumCarriers();
        $scheduler = new Scheduler();
        $arrayListTime = $scheduler->getTimeDelivery($journeySlots, $numCarriers);
        return $arrayListTime;
    }
}
