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
        //read price policies
        $ini_array = parse_ini_file("configApp/CarrierConfig.ini", true);

        //initialize price
        $finalPrice = new Price(0, $this->getCurrency());
        $priceTemp=0;
        //analyze products and update price
       /* foreach ($order_in->getCarriers() as &$carr) {

            //carrier price
            $priceTemp=$priceTemp+$ini_array['carrierPrice'];

            foreach ($carr->getProducts() as &$prod) {
                //product price
                $priceTemp=$priceTemp+$prod->getPrice();
                //transport type
                $priceTemp=$priceTemp+$ini_array[$prod->getType()];
            }
        }*/

       for($i=0; $i<4; $i++)
        {
            $priceTemp=$priceTemp+2;

            for($j=0; $j<4; $j++)
            {
                //product price
                $priceTemp=$priceTemp+1;
                //transport type
                $priceTemp=$priceTemp+$ini_array['types']['normal'];
            }

        }

        //set final price
        return $priceTemp;
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
