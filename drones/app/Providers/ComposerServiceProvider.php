<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
	{
		view()->composer('insertProduct', 'App\Htpp\ViewComposers\ProductComposer');

		/*
        View::composer('insertProduct',  function($view)
        {
            $transportEnterprise = \App\Models\TransportEnterprise::find(1);
            $catalog = \App\Models\Catalog::find($transportEnterprise->catalog_id);
            $products = \App\Models\ProductDescription::where('catalog_id', $catalog->id)->get();
            //$view->with(compact('products'));
            $view->with(compact('ciao', 'Hello World'));
        });
		*/
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
