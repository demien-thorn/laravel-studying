<?php

namespace App\Services;

use App\Models\Currency;

class CurrencyConversion
{
    protected static $container;

    public static function loadContainer()
    {
        if (is_null(value: self::$container)) {
            $currencies = Currency::get();
            foreach ($currencies as $currency) {
                self::$container[$currency->code] = $currency;
            }
        }
    }

    public static function getCurrencies()
    {
        return self::$container;
    }

    public static function convert($sum, $originCurrencyCode = 'UAH', $targetCurrencyCode = null)
    {
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencyCode];

        if (is_null(value: $targetCurrencyCode)) {
            $targetCurrencyCode = session(key: 'currency', default: 'UAH');
        }
        $targetCurrency = self::$container[$targetCurrencyCode];

        return $sum / $targetCurrency->rate * $originCurrency->rate;
    }

    public static function getCurrencySymbol()
    {
        self::loadContainer();

        $currencyBySession = session(key: 'currency', default: 'UAH');

        $currency = self::$container[$currencyBySession];
        return $currency->symbol;
    }
}
