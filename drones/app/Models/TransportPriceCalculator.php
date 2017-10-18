<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 18/10/17
 * Time: 11.08
 */

namespace App\Models;


class TransportPriceCalculator extends PriceCalculator
{
    public function calculatePrice($order_in)
    {
        //read policies
        $currencyConf = config('currency.currency.defaultCurrency');

        //initialize price
        $finalPrice = new Price(0, $currencyConf);
        $priceTemp=0;
        //analyze products and update price
        /*foreach ($order_in->getCarriers() as &$carr) {

             //carrier price
             $priceTemp=$priceTemp+config('carrier.carrierPrice');

             foreach ($carr->getProducts() as &$prod) {
                 //product price
                 $priceTemp=$priceTemp+$prod->getPrice();
                 //transport type
                 $priceTemp=$priceTemp+config('carrier.carrierType.'.$prod->getType().'\'');
             }
         }*/

        for($i=0; $i<4; $i++)
        {
            $priceTemp=$priceTemp+config('carrier.carrierPrice');

            for($j=0; $j<4; $j++)
            {
                //product price
                $priceTemp=$priceTemp+1;
                //transport type
                $priceTemp=$priceTemp+config('carrier.carrierType.cold');
            }

        }

        //set final price
        return $priceTemp;
    }
}