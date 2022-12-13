<?php

namespace App\Dexlib;
use Arr;

class Currency
{	

	/**
     * @var array
     */
    public static $_currency = [];

    /**
     * @return array|mixed
     */
    public static function getAllCurrency()
    { 
        if (empty(self::$_currency)) {
            $currenciesJson = file_get_contents(__DIR__.'/Locale/data/currencies.json');
            $currenciesList = json_decode($currenciesJson, true);
            $currencies = [];
            foreach ($currenciesList as $key => $value) {
               $currencies[$value['code']] = $value;
            }
            $currencies =  Arr::sort($currencies);
            self::$_currency = $currencies;
        }

        return self::$_currency;
    }



 
}

		