<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 18/10/17
 * Time: 11.08
 */

namespace App\Utility;


class TransportPriceCalculator extends PriceCalculator
{
    public function calculatePrice($order_in)
    {
        //initialize price
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
         }
        $pathLengthPrice = config('path.pricePerKm') * $order_in->getPath()->getLength();
        */
//TEST
        for($i=0; $i<4; $i++)
        {
            $priceTemp=$priceTemp+config('carrier.carrierPrice');

            for($j=0; $j<4; $j++)
            {
                //product price
                $priceTemp=$priceTemp+1;
                //transport type
                $priceTemp=$priceTemp+config('carrier.carrierType.hot');
            }

        }

        $pathLengthPrice = config('path.pricePerKm')*3;
        $priceTemp = $priceTemp+$pathLengthPrice;
        //set final price
        return $priceTemp;
    }
}