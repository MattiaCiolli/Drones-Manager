<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceContext extends Model
{
    private $order = NULL;
    private $priceCalculatorState = NULL;

    public function __construct($order_in, $priceCalculatorState_in) {
        $this->order = $order_in;
        $this->setPriceCalculatorState($priceCalculatorState_in);
    }

    public function getOrder() {
        return $this->order;
    }

    public function setPriceCalculatorState($priceCalculatorState_in) {
        $this->priceCalculatorState = $priceCalculatorState_in;
    }

    public function preventive() {
        return $this->priceCalculatorState->calculatePrice($this->order);
    }
}
