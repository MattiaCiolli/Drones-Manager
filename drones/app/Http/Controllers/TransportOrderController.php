<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
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
		$orderService->newOrderTransport();
        return view('insertAddress');
	}

    public function productAnalysis(ProductService $productService, CarrierService $carrierService, OrderService $orderService, PriceService $priceService, Request $request){

        $jsonProductsList = $request->input('products');

        $stringProductList = json_decode($jsonProductsList);

        $transportOrder = \App\Models\TransportOrder::find(1);
        //$carriers = $transportOrder->carrier;
        $carriers = $carrierService->allCarrierOF($transportOrder->id);
		if(count($carriers) && count($transportOrder->price())){
            $carrierService->deleteTemporaryOrderData($carriers);
        }

        $productList = $productService->generateProducts($stringProductList);
        $carriersList = $carrierService->handleProduct($productList);

        $orderService->consignCarriers($carriersList);



        $totaleProdotti = $priceService->CalculateTransportPrice($transportOrder);
        $transportOrder->save();

        $transportOrder = $transportOrder->fresh();

        return $orderService->shortOrderBill($transportOrder, $totaleProdotti);
    }

	public function insertAddress(AddressService $addressService, PathService $pathService)
    {
		$jsonAddressInit = request()->input('address');
		$jsonAddress = json_decode($jsonAddressInit);
        $addressDestination = $addressService->parseAddress($jsonAddress);
        $addressIsValid = $addressService->checkAddress($addressDestination);

		if($addressIsValid)
		{
			$order = \App\Models\TransportOrder::find(1);

			$path = $pathService->generatePath($addressDestination, $order->maitre->enterprise->address, $order->maitre->enterprise->hangar->address);

			if($path)
			{
				$addressDestination->save();
				$path->save();

				$order->setPath($path);
				$order->setAddress($addressDestination);
				$order->save();

                return response()->json([
                'msg' => "Indirizzo valido!",
                'addressIsValid' => true
                ]);
			}
			else
			{
				return response()->json([
                'error' => 'Indirizzo non valido!',
                'addressIsValid' => false
            ]);
			}
		}
		else{
            return response()->json([
                'msg' => 'Indirizzo non valido!',
                'addressIsValid' => false
            ]);
        }
    }

    public function insertProduct()
{
    return view('insertProduct');
}



    public function orderSummary()
    {
        return view('orderSummary');
    }
}
