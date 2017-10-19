<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 18/10/17
 * Time: 10.54
 */

namespace App\Services;

use App\Models\Price;
use App\Models\PriceContext;
use App\Models\TransportPriceCalculator;

class PriceService
{
    public function CalculateTransportPrice($order_in)
    {
        $priceContext = new PriceContext(null, new TransportPriceCalculator());
        $priceValue=$priceContext->preventive();
        //read currency
        $currencyConf = config('currency.currency.defaultCurrency');
        /*
        $price = new Price();
        $price->setCurrency($currencyConf);
        $price->setValue($priceValue);
        $order_in.setPrice($price);
        $price->save();
        $order_in->save();
        */
        return $priceValue;
    }
}