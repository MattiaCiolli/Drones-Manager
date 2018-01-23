<?php

namespace App\Http\Controllers;

use App\Models\TransportOrder;
use App\Events\ResourcesReserved;
use App\Models\Slot;
use App\Utility\SchedulerContext;

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
        $schedulerContext = new SchedulerContext($transportOrder);
        $timeDelivery = $schedulerContext->getTimeDelivery($journeySlots);
        return view('confirm', ['timeDelivery' => $timeDelivery]);
        //return $arrayListTime;
    }

    public function confirmOrder(){
        $idOrder = 1;  //????
        $transportOrder = new TransportOrder();
        $transportOrder = \App\Models\TransportOrder::find($idOrder);

        $scheduler = new SchedulerContext($transportOrder);
        $scheduler->confirmedOrder();

        $carrier = $transportOrder->carrier;

		$drones = collect([]);
		$pilots = collect([]);
		$technicians = collect([]);

        //trovato bug per il tecnico per il caso di piu carrier. Sono affidati allo stesso tecnico
        foreach ($carrier as $carri){
            $drones->push(["droneId" => $carri->syncTable->findDronIndex, "slot" => $carri->syncTable->scanIndex, "consecutive" => $carri->syncTable->journey_slots]);
			$pilots->push(["pilotId" => $carri->syncTable->findPilotIndex, "slot" => $carri->syncTable->scanIndex, "consecutive" => $carri->syncTable->journey_slots]);
			$technicians->push(["technicianId" => $carri->syncTable->findTechnicianIndex, "slot" => $carri->syncTable->scanIndex, "consecutive" => $carri->syncTable->journey_slots]);
        }

		event(new ResourcesReserved($drones, $pilots, $technicians));

        return view('totalConfirm');

    }

}
