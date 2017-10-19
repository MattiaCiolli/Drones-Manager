<?php

namespace App\Http\Controllers;

use App\Models\PriceContext;
use App\Models\TransportPriceCalculator;
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
	}

    /*
     *  $jsonProductsList dovrà contenere un json che conterrà
     *  ID di descrittori con relative quantità
     *
     *
     * */
    public function productAnalysis(/*$jsonProductsList*/){

        // $jsonProductsList utilizzato solo per debug
        $jsonProductsList='{"productDescriptionID":[1, 2, 3], "productQuantity":[2, 5, 6]}';
        $stringProductList = json_decode($jsonProductsList);

        //In questo momento sto creando gli oggetti service ma in un futuro prossimo questo
        //dovrà ripreso dal Singleton
        $productService = new ProductService();
        $carrierService = new CarrierService();
        $orderService = new OrderService();

        $productList = $productService->generateProducts($stringProductList);   //da modificare con catalogo
        $carriersList = $carrierService->handleProduct($productList);
        $orderService->consignCarriers($carriersList);
    }

	public function insertAddress($destinationAddress)
	{
		//In questo momento sto creando l'oggetto ma in un futuro prossimo questo
		//dovrà ripreso dal Singleton
		$addressService = new AddressService();
		$jsonAddress = json_decode($destinationAddress);
		$address = $addressService->parseAddress($jsonAddress);
		$addressIsValid = $addressService->checkAddress($address);
		if($addressIsValid)
			echo("L'indirizzo è valido");
		else
			echo("L'indirizzo non è valido");
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

}
