<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\ProductService;

class SummaryComposer
{
    private $order;
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $transportOrder= \App\Models\TransportOrder::find(1);
        //accedere a config
        $this->order[0]= $transportOrder;
        //fare parse per controllare valore dello sconto
        $this->order[1]= config('price.discountStrategies.quantity');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('order', $this->order);
    }
}
