<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use App\Utility\PriceContext;
use App\Utility\TransportPriceCalculator;
use App\Services\CarrierService;
use App\Services\ConfigurationService;
use App\Services\PriceService;
use App\Services\ProductService;
use App\Services\OrderService;
use App\Services\AddressService;
use App\Services\PathService;
use App\Models\TransportOrder;

class TransportOrderController extends Controller
{

    public function newOrder(OrderService $orderService)
	{
		//In questo momento sto creando l'oggetto ma in un futuro prossimo questo
		//dovrà ripreso dal Singleton
		//$orderService = new OrderService();
		$orderService->newOrderTransport();
        return view('insertAddress');
	}

    public function productAnalysis(ProductService $productService, CarrierService $carrierService, OrderService $orderService, PriceService $priceService, Request $request){

        //$jsonProductsList='{"productDescriptionID":[1], "productQuantity":[1]}';
        $jsonProductsList = $request->input('products');

        $stringProductList = json_decode($jsonProductsList);

        //In questo momento sto creando gli oggetti service ma in un futuro prossimo questo
        //dovrà ripreso dal Singleton
        //$productService = new ProductService();
        //$carrierService = new CarrierService();
        //$orderService = new OrderService();

        //ordine da recuperare da sessione
        $transportOrder = \App\Models\TransportOrder::find(1);
        //$carriers = \App\Models\Carrier::where('transport_order_id', $transportOrder->id)->get();
        $carriers = $transportOrder->carrier;
        if(count($carriers) && count($transportOrder->price())){
            $this->deleteTemporaryOrderData($carriers);
        }

        $productList = $productService->generateProducts($stringProductList);
        $carriersList = $carrierService->handleProduct($productList);

        $orderService->consignCarriers($carriersList);
		$totaleProdotti = $priceService->CalculateTransportPrice($transportOrder);
        $transportOrder->save();

        $transportOrder = $transportOrder->fresh();
        $json['totaleOrdine'] = $transportOrder->price->value;
        $json['numeroCarrier'] = count($transportOrder->carrier);
        $json['totaleProdotti']= $totaleProdotti;
        $json['simbolo']= $transportOrder->price->currency->currency_symbol;
        //$json=$totalCost." ".$numberOfCarrier;
        $json = json_encode($json);
        return $json;

        //ritornare un json con i dati da vedere in msg della chaiamat ajax
    }

	public function insertAddress(AddressService $addressService, PathService $pathService)
    {
        //In questo momento sto creando l'oggetto ma in un futuro prossimo questo
        //dovrà ripreso dal Singleton

        //MODIFICHE: i valori che ritornano da ajax vengono ripresi singolarmente e passati alla funzione che adesso
        // accetta 3 parametri e non più un JSON

		//$addressService = new AddressService();
		$jsonAddressInit = request()->input('address');
		$jsonAddress = json_decode($jsonAddressInit);
        $addressDestination = $addressService->parseAddress($jsonAddress);
        $addressIsValid = $addressService->checkAddress($addressDestination);

		if($addressIsValid)
		{
			//queste cose poi vanno spostate
			$order = \App\Models\TransportOrder::find(1);
			//$pathService = new PathService();
			$path = $pathService->generatePath($addressDestination, $order->maitre->enterprise->address, $order->maitre->enterprise->hangar->address);

			if($path)
			{
				$addressDestination->save();
				$path->save();

				$order->path_id = $path->id;
				$order->address_id = $addressDestination->id;
				$order->save();

                return response()->json([
                'msg' => "Indirizzo valido!",
                'addressIsValid' => $addressIsValid
                ]);
			}
			else
			{
				return response()->json([
                'error' => 'Indirizzo non valido!',
                'addressIsValid' => $addressIsValid
            ]);
			}
		}
		else{
            return response()->json([
                'msg' => 'Indirizzo non valido!',
                'addressIsValid' => $addressIsValid
            ]);
        }
    }

    public function insertProduct()
    {
        return view('insertProduct');
    }

    public function deleteTemporaryOrderData($carriers)
    {

        //ordine da recuperare da sessione
        $transportOrder = TransportOrder::find(1);
        //$carriers = \App\Models\Carrier::where('transport_order_id', $transportOrder->id)->get();
        foreach ($carriers as $carrier) {
            $carrier->delete();
        }
        $transportOrder->price()->delete();
    }

    public function orderSummary()
    {
        return view('orderSummary');
    }

}
