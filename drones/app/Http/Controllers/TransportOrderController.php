<?php

namespace App\Http\Controllers;

use App\Utility\PriceContext;
use App\Utility\TransportPriceCalculator;
use App\Services\CarrierService;
use App\Services\ConfigurationService;
use App\Services\PriceService;
use App\Services\ProductService;
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

        $address = request()->input('address');
        $lat = request()->input('coorLat');
        $lon = request()->input('coorLng');
		$addressService = new AddressService();

		//$jsonAddress = json_decode($destinationAddress);

        $address = $addressService->parseAddress($address,$lat,$lon);
        //$address = $addressService->parseAddress($jsonAddress);

        //NB probabilmente c'è qualche errore nella validazione dell'indirizzo quindi per l'happy path ora è a true.

        //$addressIsValid = $addressService->checkAddress($address);
		$addressIsValid=true;

		if($addressIsValid)
			return response()->json("L'indirizzo e' valido");
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
