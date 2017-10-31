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
        $transportOrder = \App\Models\TransportOrder::find(1);
        //accedere a config
        $this->order[0] = $transportOrder;
        $d = array();
        if (strlen($transportOrder->price->discount) > 0) {
            for ($i = 0; $i < strlen($transportOrder->price->discount); $i++) {
                $char = substr($transportOrder->price->discount, $i, 1);
                if (strpos($char, 'P') !== false) {
                    $d[$i][0] = "Sovrapprezzo lunghezza percorso:";
                    $d[$i][1] = config('price.discountStrategies.pathLength') . " " . $transportOrder->price->currency->currency_symbol;
                } elseif (strpos($char, 'Q') !== false) {
                    $d[$i][0] = "Sconto quantità:";
                    $d[$i][1] = $this->percentage(config('price.discountStrategies.quantity'));
                }
            }
            $this->order[1] = $d;
        } else {
            $d[0][0] = "Nessuno sconto/sovrapprezzo applicato";
            $d[0][1] = "";
            $this->order[1] = $d;
        }
    }

    public function percentage($in)
    {
        $in = 100 - ($in * 100);
        return $in . "%";
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('order', $this->order);
    }
}
