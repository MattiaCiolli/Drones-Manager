<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 19/10/17
 * Time: 19.03
 */

namespace App\Utility;

class PriceStrategyContext
{
    private $strategy = NULL;
    //bookList is not instantiated at construct time
    public function __construct($strategy_ind_id) {
        switch ($strategy_ind_id) {
            case "S":
                $this->strategy = new SummerStrategy();
                break;
            case "Q":
                $this->strategy = new QuantityStrategy();
                break;
            case "P":
                $this->strategy = new PathLengthStrategy();
                break;
            case "F":
                $this->strategy = new FidelityStrategy();
        }
    }
    public function discount($value_in) {
        return $this->strategy->discount($value_in);
    }
}