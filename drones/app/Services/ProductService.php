<?php
/**
 * Created by PhpStorm.
 * User: Davide
 * Date: 12/10/2017
 * Time: 17:04
 */

namespace App\Services;


use App\Models\Product;

class ProductService
{

    public function generateProducts($stringProductList){
        $descriptionsID = $stringProductList->productDescriptionID;
        $quantity = $stringProductList->productQuantity;

        $productList = array();

        for ($i = 0; $i < count($descriptionsID); $i++) {
            for ($j = 0; $j < $quantity[$i]; $j++){
                $product = new Product();

                //invece di recuperarli direttamente dovrebbe passare dal catalogo
                $productDescription = \App\Models\ProductDescription::find($descriptionsID[$i]);

                $product->setDescription($productDescription);
                $product->save();
                $productList[] = $product;
            }
        }
        return $productList;

    }
}