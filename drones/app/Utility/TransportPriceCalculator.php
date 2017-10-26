<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 18/10/17
 * Time: 11.08
 */

namespace App\Utility;


use App\Models\TransportOrder;

class TransportPriceCalculator extends PriceCalculator
{
    public function calculatePrice($order_in)
    {
        $discountId="";
        //initialize price
        $priceTemp=0;
        $i=0;
        //analyze products and update price
        foreach ($order_in->carrier as &$carr) {

            //carrier price
            $priceTemp=$priceTemp+config('carrier.carrierPrice');

            foreach ($carr->product as &$prod) {
                $i++;
                //product price
                $priceTemp=$priceTemp+$prod->description->price;
                //transport type
                $priceTemp=$priceTemp+config('carrier.carrierType.'.$prod->description->type);
            }
        }

        if($i>=config('price.strategyParameters.quantity'))
        {
            $priceStrategyContext = new PriceStrategyContext('Q');
            $priceTemp= $priceStrategyContext->discount($priceTemp);
            $discountId.="Q";
        }

        $pathLengthPrice = config('path.pricePerKm') * ($order_in->path->path_length/1000);
        $priceTemp=$priceTemp+$pathLengthPrice;

        if($order_in->path->path_length>config('price.strategyParameters.pathLength'))
        {
            $priceStrategyContext = new PriceStrategyContext('P');
            $priceTemp= $priceStrategyContext->discount($priceTemp);
            $discountId.="P";
        }

        /*if(//summer)
        {
            $priceStrategyContext = new PriceStrategyContext('S');
            $priceTemp= $priceStrategyContext->discount($priceTemp);
        }

        if(//fidelity)
        {
            $priceStrategyContext = new PriceStrategyContext('F');
            $priceTemp= $priceStrategyContext->discount($priceTemp);
        }*/

        //set final price
        return array (round($priceTemp, 2), $discountId);
    }
}