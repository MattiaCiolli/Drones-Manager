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
use App\Models\TransportOrder;

class TransportOrderController extends Controller
{

    public function newOrder() {
		//In questo momento sto creando l'oggetto ma in un futuro prossimo questo
		//dovrà ripreso dal Singleton
		$orderService = new OrderService();
		$orderService->newOrderTransport();
        return view('insertAddress');
	}


    public function productAnalysis(){

        //$jsonProductsList='{"productDescriptionID":[1, 4, 6], "productQuantity":[2, 5, 6]}';
        $jsonProductsList = request()->input('products');

        $stringProductList = json_decode($jsonProductsList);

        //In questo momento sto creando gli oggetti service ma in un futuro prossimo questo
        //dovrà ripreso dal Singleton
        $productService = new ProductService();
        $carrierService = new CarrierService();
        $orderService = new OrderService();

        $productList = $productService->generateProducts($stringProductList);
        $carriersList = $carrierService->handleProduct($productList);

        $orderService->consignCarriers($carriersList);
        $this->calculatePrice();

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
        $addressIsValid = $addressService->checkAddress($addressDestination);

		if($addressIsValid)
		{
			//queste cose poi vanno spostate
			$order = \App\Models\TransportOrder::find(1);

			$pathService = new PathService();
			$path = $pathService->generatePath($addressDestination, $order->maitre->enterprise->address, $order->maitre->enterprise->hangar->address);

			if($path)
			{
				$addressDestination->save();
				$path->save();

				$order->path_id = $path->id;
				$order->address_id = $addressDestination->id;
				$order->save();
				
				return response()->json("L'indirizzo e' valido");
			}
			else
			{
				return response()->json("L'indirizzo non e' valido");
			}
		}
    }


    public function calculatePrice()
    {
        $priceServ = new PriceService();
        $finalPrice = $priceServ->CalculateTransportPrice(TransportOrder::find(1));
        return $finalPrice;
    }


    public function insertProduct()
    {
        $productService = new ProductService();
        $products = $productService->productForView();
        return view('insertProduct', compact('products'));
    }
}
