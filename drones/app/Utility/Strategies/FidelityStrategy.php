<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 19/10/17
 * Time: 19.16
 */

namespace App\Utility;

class FidelityStrategy implements PriceStrategy
{
    public function discount($value_in)
    {
        $value_in = $value_in * config('price.discountStrategies.fidelity');
        return $value_in;
    }
}
