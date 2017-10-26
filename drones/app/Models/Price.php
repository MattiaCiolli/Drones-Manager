<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    private $value;
    protected $table = 'prices';
    protected $fillable = ['value', 'discount'];

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->fill(['value' => $value]);
    }

    public function getDiscount()
    {
        return $this->value;
    }

    public function setDiscount($value)
    {
        $this->fill(['discount' => $value]);
    }

    public function setCurrency($currency)
    {
        $this->currency()->associate($currency);
    }

    public function ordTransport()
    {
        return $this->hasOne(TransportOrder::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
