<?php

namespace App\Services;

use App\Models\Currency;
use Carbon\Carbon;

class CurrencyConversion
{
    const DEFAULT_CURRENCY_CODE = 'UAH';
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
        self::loadContainer();
        return self::$container;
    }

    public static function getCurrencyFromSession()
    {
        return session(key: 'currency', default: self::DEFAULT_CURRENCY_CODE);
    }

    public static function getCurrentCurrencyFromSession()
    {
        self::loadContainer();
        $currencyCode = self::getCurrencyFromSession();

        foreach (self::$container as $currency) {
            if ($currency->code === $currencyCode) {
                return $currency;
            }
        }
    }

    public static function convert($sum, $originCurrencyCode = self::DEFAULT_CURRENCY_CODE, $targetCurrencyCode = null)
    {
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencyCode];

        if ($originCurrency->code != self::DEFAULT_CURRENCY_CODE &&
            ($originCurrency->rate == 0 || $originCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay())) {
                CurrencyRates::getRates();
                self::loadContainer();
                $originCurrency = self::$container[$originCurrencyCode];
        }

        if (is_null(value: $targetCurrencyCode)) {
            $targetCurrencyCode = self::getCurrencyFromSession();
        }

        $targetCurrency = self::$container[$targetCurrencyCode];
        if ($targetCurrency->code != self::DEFAULT_CURRENCY_CODE &&
            ($targetCurrency->rate == 0 || $targetCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay())) {
            CurrencyRates::getRates();
            self::loadContainer();
            $targetCurrency = self::$container[$targetCurrencyCode];
        }

        $roundingSum = $sum / $originCurrency->rate * $targetCurrency->rate;
        if ($roundingSum %10 >=5) {
            $roundedSum = ceil(num: $roundingSum / 10) * 10;
        } else {
            $roundedSum = floor(num: $roundingSum / 10) * 10;
        }

        return $roundedSum;
    }

    public static function getCurrencySymbol()
    {
        self::loadContainer();

        $currencyBySession = self::getCurrencyFromSession();

        $currency = self::$container[$currencyBySession];
        return $currency->symbol;
    }

    public static function getBaseCurrency()
    {
        self::loadContainer();

        foreach (self::$container as $code => $currency) {
            if ($currency->isMain()) {
                return $currency;
            }
        }
    }
}
