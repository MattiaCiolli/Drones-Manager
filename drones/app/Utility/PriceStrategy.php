<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 19/10/17
 * Time: 19.06
 */

namespace App\Utility;


interface PriceStrategy
{
    public function discount($value_in);
}