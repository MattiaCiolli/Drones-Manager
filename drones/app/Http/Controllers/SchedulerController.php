<?php

namespace App\Http\Controllers;

use App\Models\TransportOrder;
use App\Events\ResourcesReserved;
use App\Models\Slot;
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
        $timeDelivery = $scheduler->getTimeDelivery($journeySlots, $numCarriers, $idOrder);
        return view('confirm', ['timeDelivery' => $timeDelivery]);
        //return $arrayListTime;
    }

    public function confirmOrder(){
        $idOrder = 1;  //????
        $transportOrder = new TransportOrder();
        $transportOrder = \App\Models\TransportOrder::find($idOrder);
        $slots = $transportOrder->slots;

        foreach ($slots as $s)
        {
            $s->state = "busy";
            $s->save();
        }

		$drones = collect(["droneId" => 1, "slot" => 5, "consecutive" => 3]);
		$pilots = collect(["pilotId" => 2, "slot" => 5, "consecutive" => 3]);
		$technicians = collect(["techniciansId" => 3, "slot" => 5]);

		event(new ResourcesReserved($drones, $pilots, $technicians));

        return view('totalConfirm');

    }

}
