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
		view()->composer('insertProduct', 'App\Http\ViewComposers\ProductComposer');
        view()->composer('orderSummary', 'App\Http\ViewComposers\SummaryComposer');
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
