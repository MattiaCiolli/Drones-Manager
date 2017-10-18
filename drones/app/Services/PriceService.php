<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 18/10/17
 * Time: 10.54
 */

namespace App\Services;

use App\Models\PriceContext;
use App\Models\TransportPriceCalculator;

class PriceService
{
    public function CalculateTransportPrice($order_in)
    {
        $priceContext = new PriceContext(null, new TransportPriceCalculator());
        return $priceContext->preventive();
    }
}