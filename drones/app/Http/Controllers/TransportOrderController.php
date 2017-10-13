<?php

namespace App\Http\Controllers;

use App\Services\CarrierService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Services\OrderService;

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
        $jsonProductsList='{"productDescriptionID":[2, 3], "productQuantity":[5, 6]}';
        $stringProductList = json_decode($jsonProductsList);

        //In questo momento sto creando gli oggetti service ma in un futuro prossimo questo
        //dovrà ripreso dal Singleton
        $productService = new ProductService();
        $carrierService = new CarrierService();

        $productList = $productService->generateProducts($stringProductList);   //da modificare con catalogo
        $carriersList = $carrierService->handleProduct($productList);           //da modificare con gestione carriers

        /*  Da fare
        $orderService->consignCarriers($carriersList);
        */
    }
}
