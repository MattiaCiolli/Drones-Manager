<?php

namespace App\Utility;

use App\Utility\SchedulerTransportOrderStrategy;
use App\Models\Order;
use App\Models\TransportOrder;

class SchedulerContext
{
	private $strategy;

	public function __construct(Order $order) {
		if($order instanceof TransportOrder) {
            $this->strategy = new SchedulerTransportOrderStrategy($order);
        }
    }

    public function getTimeDelivery($journeySlots) {
    	return $this->strategy->getTimeDelivery($journeySlots);
    }

	public function confirmedOrder()
	{
		return $this->strategy->confirmedOrder();
	}

	public function cancelOrder()
	{
		return $this->strategy->cancelOrder();
	}
}
