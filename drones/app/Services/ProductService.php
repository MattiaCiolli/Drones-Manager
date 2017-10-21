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

    public function generateProducts($stringProductList ){

        // In questo momento sto prendendo l'id dell'enterprise fisso, ma in futuro dovrà
        //  essere recuperato da sessione
        $transportEnterprise=\App\Models\TransportEnterprise::find(1);

        $catalog = \App\Models\Catalog::find($transportEnterprise->catalog_id);
        $productCatalog = \App\Models\ProductDescription::where('catalog_id', $catalog->id)->get();
        $productCatalog = $productCatalog->keyBy('id');

        $descriptionsID = $stringProductList->productDescriptionID;
        $quantity = $stringProductList->productQuantity;

        $productList = array();

        for ($i = 0; $i < count($descriptionsID); $i++) {
            for ($j = 0; $j < $quantity[$i]; $j++){
                $product = new Product();

                $productDescription=$productCatalog->get($descriptionsID[$i]);

                $product->setDescription($productDescription);
                $product->save();
                $productList[] = $product;
            }
        }
        return $productList;

    }

    public function productForView(){
        // In questo momento sto prendendo l'id dell'enterprise fisso, ma in futuro dovrà
        //  essere recuperato da sessione
        $transportEnterprise=\App\Models\TransportEnterprise::find(1);

        $catalog = \App\Models\Catalog::find($transportEnterprise->catalog_id);
        $productCatalog = \App\Models\ProductDescription::where('catalog_id', $catalog->id)->get();
        return $productCatalog;
    }

}