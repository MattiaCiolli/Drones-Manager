<?php
/**
 * Created by PhpStorm.
 * User: Davide
 * Date: 13/10/2017
 * Time: 14:22
 */

namespace App\Services;


use App\Models\Carrier;

class CarrierService
{

    public function handleProduct($productList){


        /*****************************************/
        //Logica da implementare diversamente, cosa fatta per vedere se le cose funzionano
        $carrier1 = new Carrier();
        $carrier2 = new Carrier();
        $carrier1->save();
        $carrier2->save();
        foreach ($productList as $product) {
            if($product->description->type == 'Cold'){
                $product->setCarrier($carrier1);
            }
            else{
                $product->setCarrier($carrier2);
            }
            $product->save();
        }
        $carriersList[]=$carrier1;
        $carriersList[]=$carrier2;
        /****************************************/

        return $carriersList;
    }

}