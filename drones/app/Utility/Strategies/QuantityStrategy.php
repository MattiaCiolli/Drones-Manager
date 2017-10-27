<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 19/10/17
 * Time: 19.15
 */

namespace App\Utility;


class QuantityStrategy implements PriceStrategy
{
    public function discount($value_in)
    {
        $value_in = $value_in * config('price.discountStrategies.quantity');
        return $value_in;
    }
}
