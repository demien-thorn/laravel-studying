<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CurrencyRates
{
    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public static function getRates(): void
    {
        $baseCurrency = CurrencyConversion::getBaseCurrency();

        $url = config(key: 'currency_rates.api_url').'?base='.$baseCurrency->code;

        $client = new Client();
        $response = $client->request(
            method: 'GET',
            uri: $url,
            options: ['headers' => ['apikey' => 'RdXtz6F2qsoafyInpVOLGV7ZTzEWgmqz']]);
        if ($response->getStatusCode() !== 200) {
            throw new Exception(message: 'There is a problem with a currency rate service');
        }

        $rates = json_decode(json: $response->getBody()->getContents(), associative: true)['rates'];

        foreach (CurrencyConversion::getCurrencies() as $currency) {
            if (!$currency->isMain()) {
                if (!isset($rates[$currency->code])) {
                    throw new Exception(message: 'There is a problem with a currency'.$currency->code);
                } else {
                    $currency->update(['rate' => $rates[$currency->code]]);
                    $currency->touch();
                }
            }
        }
    }
}
