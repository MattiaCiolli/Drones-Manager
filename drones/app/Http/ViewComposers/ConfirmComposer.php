<?php
/**
 * Created by PhpStorm.
 * User: Giovanna
 * Date: 12/01/2018
 * Time: 19:45
 */

namespace App\Http\ViewComposers;
use Illuminate\View\View;

class ConfirmComposer
{
    private $timeDelivery;

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $view->with('timeDelivery', $this->timeDelivery);
    }
}