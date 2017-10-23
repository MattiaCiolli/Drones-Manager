<?php

namespace App\Http\Controllers;

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

class TransportOrderController extends Controller
{

    public function newOrder() {
		//In questo momento sto creando l'oggetto ma in un futuro prossimo questo
		//dovrà ripreso dal Singleton
		$orderService = new OrderService();
		$orderService->newOrderTransport();
        return view('insertAddress');
	}

    /*
     *  $jsonProductsList dovrà contenere un json che conterrà
     *  ID di descrittori con relative quantità
     *
     *
     * */
    public function productAnalysis(/*$jsonProductsList*/){

        $jsonProductsList = request()->input('products');

        // $jsonProductsList utilizzato solo per debug
        //$jsonProductsList='{"productDescriptionID":[1, 3, 4], "productQuantity":[2, 5, 6]}';
        $stringProductList = json_decode($jsonProductsList);
        //In questo momento sto creando gli oggetti service ma in un futuro prossimo questo
        //dovrà ripreso dal Singleton
        $productService = new ProductService();
        $carrierService = new CarrierService();
        $orderService = new OrderService();
        $productList = $productService->generateProducts($stringProductList);   //da modificare con catalogo
        $carriersList = $carrierService->handleProduct($productList);
        $orderService->consignCarriers($carriersList);
        return response()->json("Ok");

    }

	public function insertAddress()
    {
        //In questo momento sto creando l'oggetto ma in un futuro prossimo questo
        //dovrà ripreso dal Singleton

        //MODIFICHE: i valori che ritornano da ajax vengono ripresi singolarmente e passati alla funzione che adesso
        // accetta 3 parametri e non più un JSON

		$addressService = new AddressService();
		$jsonAddressInit = request()->input('address');
		$jsonAddress = json_decode($jsonAddressInit);
        $addressDestination = $addressService->parseAddress($jsonAddress);
        echo($addressDestination->getLatitudine());

        //NB probabilmente c'è qualche errore nella validazione dell'indirizzo quindi per l'happy path ora è a true.

        $addressIsValid = $addressService->checkAddress($addressDestination);

		if($addressIsValid)
		{
			//queste cose poi vanno spostate
			$order = \App\Models\TransportOrder::find(1);
			$order->address = $addressDestination;
			$order->save();
			$pathService = new PathService();

			//bisogna agiustare diverse cose nelle tabelle prima che qeusta cosa funzioni
			//per scopi di test per il momento inserisco dati fasulli
			$pathService->generatePath($address->getLongitudine, $address->getLatitudine, 41.89193, 12.51133, 42.35055, 13.39954);

			return response()->json("L'indirizzo e' valido");
		}
		else
			return response()->json("L'indirizzo non e' valido");

    }


    /*public function calculatePrice($order_in)
    {
        $priceContext = new PriceContext($order_in, new TransportPriceCalculator());;
        return $priceContext->preventive();
    }*/

//test
    public function calculatePrice()
    {
        /*$s = ConfigurationService::getInstance();
        $s->loadConfig();*/
        $priceServ = new PriceService();
        $finalPrice = $priceServ->CalculateTransportPrice(null);
        return $finalPrice;
    }


    public function insertProduct()
    {
        $productService = new ProductService();
        $products = $productService->productForView();
        return view('insertProduct', compact('products'));
    }
}
