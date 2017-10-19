<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 19/10/17
 * Time: 19.14
 */

namespace App\Utility;


class SummerStrategy implements PriceStrategy
{
    public function discount($value_in) {
        //if estate
        $value_in= $value_in*0.9;
        return $value_in;
    }
}
