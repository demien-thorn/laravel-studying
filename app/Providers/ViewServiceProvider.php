<?php

namespace App\Providers;

use App\Services\CurrencyConversion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(views: ['layouts.master', 'categories'], callback: 'App\ViewComposers\CategoriesComposer');
        View::composer(views: ['layouts.master'], callback: 'App\ViewComposers\CurrenciesComposer');
        View::composer(views: ['layouts.master'], callback: 'App\ViewComposers\BestProductsComposer');

        View::composer(views: '*', callback: function ($view) {
            $currencySymbol = CurrencyConversion::getCurrencySymbol();
            $view->with(key: 'currencySymbol', value: $currencySymbol);
        });
    }
}
