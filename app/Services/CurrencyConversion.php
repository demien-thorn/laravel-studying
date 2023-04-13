<?php

namespace App\Services;

use App\Models\Currency;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store;

class CurrencyConversion
{
    const DEFAULT_CURRENCY_CODE = 'UAH';
    protected static $container;

    public static function loadContainer(): void
    {
        if (is_null(value: self::$container)) {
            $currencies = Currency::get();
            foreach ($currencies as $currency) {
                self::$container[$currency->code] = $currency;
            }
        }
    }

    /**
     * @return mixed
     */
    public static function getCurrencies(): mixed
    {
        self::loadContainer();
        return self::$container;
    }

    /**
     * @return Application|SessionManager|Store|mixed
     */
    public static function getCurrencyFromSession(): mixed
    {
        return session(key: 'currency', default: self::DEFAULT_CURRENCY_CODE);
    }

    /**
     * @return mixed|void
     */
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

    /**
     * @throws GuzzleException
     */
    public static function convert(
        $sum,
        $originCurrencyCode = self::DEFAULT_CURRENCY_CODE,
        $targetCurrencyCode = null
    ): float|int
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

    /**
     * @return mixed|void
     */
    public static function getBaseCurrency()
    {
        self::loadContainer();

        foreach (self::$container as $currency) {
            if ($currency->isMain()) {
                return $currency;
            }
        }
    }
}
