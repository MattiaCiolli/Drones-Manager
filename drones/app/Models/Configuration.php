<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    private $conf;

    public function __construct($conf_array)
    {
        $this->conf = $conf_array;
    }

    public function getConf()
    {
        return $this->conf;
    }

    public function setConf($conf)
    {
        $this->conf = $conf;
    }




}
