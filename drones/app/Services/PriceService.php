<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 18/10/17
 * Time: 10.54
 */

namespace App\Services;

use App\Models\Price;
use App\Models\Currency;
use App\Models\TransportOrder;
use App\Utility\PriceContext;
use App\Utility\TransportPriceCalculator;

class PriceService
{
    public function CalculateTransportPrice($order_in)
    {
        $priceContext = new PriceContext($order_in, new TransportPriceCalculator());
        $priceDiscountId=$priceContext->preventive();
        //read currency
        $currencyConf = config('currency.currency.defaultCurrency');
        $curr = Currency::where('currency_symbol', $currencyConf)->first();
        $price = new Price();
        $price->setCurrency($curr);
        $price->setFullValue($priceDiscountId[0]);
        $price->setValue($priceDiscountId[1]);
        $price->setDiscount($priceDiscountId[2]);
        $price->save();
        //$order_in=TransportOrder::find(1);
        $order_in->setPrice($price);
        $order_in->save();

        $order_in->fresh();
        $totaleProdotti = 0;
        foreach ($order_in->carrier as $carri){
            foreach ($carri->product as $prod){
                $totaleProdotti = $totaleProdotti + $prod->description->price;
            }
        }
        return $totaleProdotti;
    }
}