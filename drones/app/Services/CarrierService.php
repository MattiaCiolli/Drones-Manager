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

        $slotCarrier = config('carrier.carrier.defaultSize');
        $numberOfProduct = count($productList);


        // ordinare i prodotti nella lista rispetto alla size in modo che quando si riempie un carrier
        // si puo continuare a riempire il successivo semplicemnte con un indice sulla lista
        //while ($numberOfProduct>0){

            /*All'interno di un iterazione si riempie un carrier*/
            $carrier = new Carrier();

            //$carrier->setFreeSlots($slotCarrier);
            $carrier->free_slots=$slotCarrier;

            $carrier->save();
            $freeSlot=$carrier->free_slots;                                                 //???
            for($i = 0; $i<count($productList) && ($freeSlot>0) ;$i++){
                $sizeOfProduct = $productList[$i]->description->size;
                $slotOfProduct = config('carrier.packet.defaultSize.'.$sizeOfProduct);

                if($slotOfProduct<=$freeSlot){
                    $productList[$i]->setCarrier($carrier);                     //?? dentro al set
                    $productList[$i]->save();

                    $freeSlot=$freeSlot - $slotOfProduct;
                    $carrier->setFreeSlots($freeSlot);
                    $numberOfProduct = $numberOfProduct - 1;
                }

            }
            $carriersList[] = $carrier;

        //}


        /*****************************************/
        //Logica da implementare diversamente, cosa fatta per vedere se le cose funzionano
        /*
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
        */

        /****************************************/

        return $carriersList;
    }

}