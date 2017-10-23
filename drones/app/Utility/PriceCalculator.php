<?php

namespace App\Utility;

abstract class PriceCalculator
{
    public abstract function calculatePrice($order_in);
}

/*
class SpotPriceCalculator extends PriceCalculator
{
    public function calculatePrice($order_in)
    {

    }
}
*/
