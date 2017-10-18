<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 18/10/17
 * Time: 10.54
 */

namespace App\Services;

use App\Models\PriceContext;
use App\Models\TransportPriceCalculator;

use function MongoDB\BSON\toJSON;

class PriceService
{
    public function CalculateTransportPrice($order_in)
    {
        $priceContext = new PriceContext(null, new TransportPriceCalculator());
        /*$order_in.setPrice($priceContext->preventive());
        $order_in->save();*/
        $price=$priceContext->preventive();
        return $price;
    }
}