<?php

namespace App\Models;

use App\Services\ConfigurationService;
use Illuminate\Database\Eloquent\Model;

abstract class PriceCalculator extends Model
{
    public function getConfBySingleton()
    {
        $s = ConfigurationService::getInstance();
        return $s->getGlobalConf();
    }

    public abstract function calculatePrice($order_in);
}

class TransportPriceCalculator extends PriceCalculator
{
    public function calculatePrice($order_in)
    {
        //read policies
        $conf = $this->getConfBySingleton();

        //initialize price
        $finalPrice = new Price(0, $conf->getConf()['currency']['currency'][0]);
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
            $priceTemp=$priceTemp+$conf->getConf()['carrier']['carrierPrice'];

            for($j=0; $j<4; $j++)
            {
                //product price
                $priceTemp=$priceTemp+1;
                //transport type
                $priceTemp=$priceTemp+$conf->getConf()['carrierType']['normal'];
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
