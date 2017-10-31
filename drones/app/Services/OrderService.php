<?php

namespace App\Services;

use App\Models\TransportOrder;
use App\Models\TransportMaitre;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function newOrderTransport() {
        //Qui andrà la sessione. Ciò prevede che l'utente si sia registrato,
        //loggato. Dato che siamo nella prima iterazione queste funzionalità
        //non sono ancora state implementate. Per questo motivo scrivo un id, che
        //sicuramente esiste perché sono stati creati i seeds, direttametne a mano.
        $transportMaitre = \App\Models\TransportMaitre::find(Auth::user()->id_maitre);
        $transportOrder = new TransportOrder();
        $transportOrder->setMaitre($transportMaitre);
        $transportOrder->save();
    }

    public function consignCarriers($carriersList){

        //Qui il transport Order dovrà essere recuperato da sessione e non direttamente
        $transportOrder = \App\Models\TransportOrder::find(1);

        foreach($carriersList as $carri){
            $carri->setTransportOrder($transportOrder);
            $carri->save();
        }
        $transportOrder->save();
    }

	public function shortOrderBill($transportOrder, $totaleProdotti)
	{
		$json['totaleOrdine'] = $transportOrder->price->value;
        $json['numeroCarrier'] = count($transportOrder->carrier);
        $json['totaleProdotti']= $totaleProdotti;
        $json['simbolo']= $transportOrder->price->currency->currency_symbol;
        return json_encode($json);
	}
}
