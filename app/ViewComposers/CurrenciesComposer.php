<?php


namespace App\ViewComposers;


use App\Services\CurrencyConversion;
use Illuminate\View\View;

class CurrenciesComposer
{
    public function compose(View $view): void
    {
        $currencies = CurrencyConversion::getCurrencies();
        $view->with(key: 'currencies', value: $currencies);
    }
}
