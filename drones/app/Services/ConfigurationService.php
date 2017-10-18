<?php
/**
 * Created by PhpStorm.
 * User: mattia
 * Date: 17/10/17
 * Time: 16.31
 */

namespace App\Services;

use App\Models\Configuration;

final class ConfigurationService
{
    private static $instance;
    private $lastModified;
    private $confFile = "../config/configApp/generalConfig.ini";
    private $globalConf;


    public function getConffile()
    {
        return $this->confFile;
    }

    public function setConffile($confFile)
    {
        $this->confFile = $confFile;
    }

    public function getLastModified()
    {
        return $this->lastModified;
    }

    public function setLastModified($value)
    {
        $this->lastModified = $value;
    }

    public function setGlobalConf($value)
    {
        $this->globalConf = $value;
    }

    public function getGlobalConf()
    {
        return $this->globalConf;
    }


    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new ConfigurationService();
        }
        return self::$instance;
    }


    public function loadConfig()
    {
        $time = filemtime($this->confFile);
        echo(date ("F d Y H:i:s.",filemtime($this->confFile)));
        echo(date ("F d Y H:i:s.",$this->lastModified));
        if($this->globalConf == null || $time > $this->lastModified) {
            //read price, carrier and currency policies
            $this->globalConf=new Configuration(parse_ini_file($this->confFile, true));
            $this->lastModified=$time;
            echo(date ("F d Y H:i:s.",filemtime($this->getConffile())));
            echo(date ("F d Y H:i:s.",$this->getLastModified()));
        }
    }

}