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
    public function product()
    {
        return $this->hasMany('App/Models/Product');
    }


}