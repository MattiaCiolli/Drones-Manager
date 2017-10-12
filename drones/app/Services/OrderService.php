<?php

namespace App\Services;

use App\Models\TransportOrder;
use App\Models\TransportMaitre;

class OrderService
{
    public function newOrderTransport() {
		//Qui andrà la sessione. Ciò prevede che l'utente si sia registrato,
		//loggato. Dato che siamo nella prima iterazione queste funzionalità
		//non sono ancora state implementate. Per questo motivo scrivo un id, che
		//sicuramente esiste perché sono stati creati i seeds, direttametne a mano.
		$transportMaitre = \App\Models\TransportMaitre::find(1);
		$transportOrder = new TransportOrder();
		$transportOrder->setMaitre($transportMaitre);
		$transportOrder->save();
	}
}
