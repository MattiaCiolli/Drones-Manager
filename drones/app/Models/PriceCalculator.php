<?php

namespace App\Models;

use App\Services\ConfigurationService;
use Illuminate\Database\Eloquent\Model;

abstract class PriceCalculator extends Model
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
