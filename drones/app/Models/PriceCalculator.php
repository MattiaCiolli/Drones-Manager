<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class PriceCalculator extends Model
{
    private $currency;

    public function getCurrency()
    {
        return $this->currency;
    }

    //accedere ad un file di config
    public function setCurrency()
    {
        $this->currency = "$";
    }

    public abstract function calculatePrice($order_in);
}

class TransportPriceCalculator extends PriceCalculator
{
    public function calculatePrice($order_in)
    {
        //initialize price
        $finalPrice = new Price(0, $this->getCurrency());
        $priceTemp=0;
        //analyze products and update price
        foreach ($order_in->getCarriers() as &$carr) {

            //carrier price
            $priceTemp=$priceTemp+1;

            foreach ($carr->getProducts() as &$prod) {
                //product price
                $priceTemp=$priceTemp+$prod->getPrice();
                //transport type
                if($prod->getType()=="hot")
                {
                    $priceTemp=$priceTemp+1;
                }
                else if($prod->getType()=="normal")
                {
                    $priceTemp=$priceTemp+0;
                }
                else if($prod->getType()=="cold")
                {
                    $priceTemp=$priceTemp+2;
                }
            }
        }


        //set final price
        return $finalPrice;
    }
}
/*
class SpotPriceCalculator extends PriceCalculator
{
    public function calculatePrice($order_in)
    {

    }
}
*/
