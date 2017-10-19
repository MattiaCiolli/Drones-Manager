<?php
/**
 * Created by PhpStorm.
 * User: Davide
 * Date: 12/10/2017
 * Time: 23:51
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{

    protected $table = 'product_descriptions';

    private $size;
    private $type;
    private $description;

    public function product()
    {
        return $this->hasMany('App/Models/Product');
    }


    public function setCatalog($catalog)
    {
        $this->catalog()->associate($catalog);
    }


    public function catalog()
    {
        return $this->belongsTo('App\Models\Catalog');
    }


    public function getSize()
    {
        return $this->size;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDescription()
    {
        return $this->description;
    }


    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }



}