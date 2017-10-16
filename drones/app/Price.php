<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    private $value;
    private $currency;

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function __construct($value_in, $currency_in) {

        $this->value = $value_in;
        $this->currency = currency_in;
    }

    public function ordTransport()
    {
        return $this->belongsTo(OrderTransport::class);
    }

    public function currency()
    {
        return $this->hasOne(Currency::class);
    }
}
