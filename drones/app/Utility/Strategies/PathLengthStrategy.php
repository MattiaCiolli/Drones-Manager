<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 19/10/17
 * Time: 19.08
 */

namespace App\Utility;


class PathLengthStrategy implements PriceStrategy
{
    public function discount($value_in) {
        $value_in = $value_in+config('price.discountStrategies.pathLength');
        return $value_in;
    }
}