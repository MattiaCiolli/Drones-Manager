<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\AddressService;

class TransportOrderController extends Controller
{
    public function newOrder() {
		//In questo momento sto creando l'oggetto ma in un futuro prossimo questo
		//dovrà ripreso dal Singleton
		$orderService = new OrderService();
		$orderService->newOrderTransport();
	}

	public function insertAddress($destinationAddress)
	{
		//In questo momento sto creando l'oggetto ma in un futuro prossimo questo
		//dovrà ripreso dal Singleton
		$addressService = new AddressService();
		$jsonAddress = json_decode($destinationAddress);
		$addressService->parseAddress($jsonAddress);
	}
}
