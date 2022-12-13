<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utils extends Model
{
    use HasFactory;

   /**
     * @param string $start
     * @param string $end
     * @return array
     */
    public static function timeOptions($start = "00:00", $end = "23:30")
    {
        $return = array();
        $tNow = $tStart = strtotime($start);
        $tEnd = strtotime($end);
        $time_format = 0; 
        ($time_format) ? $format = 'H:i' : $format = 'g:i A';

        while ($tNow <= $tEnd) {
            $timestamp = (date("H", $tNow) * 3600) + (date("i", $tNow) * 60);
            $return[$timestamp] = date($format, $tNow);
            $tNow = strtotime('+30 minutes', $tNow);
        }
        
        return $return;
    }

    public static function displayPrice($price, $currency, $decimals = 2, $decimalpoint = '.', $seperator = ',', $currency_positions = 'left')
    {
        if ($currency_positions == 'left') {
            return $currency . '' . number_format(floor(($price * pow(10, $decimals))) / pow(10, $decimals), $decimals, $decimalpoint, $seperator);
        }
        if ($currency_positions == 'left_with_space') {
            return $currency . ' ' . number_format(floor(($price * pow(10, $decimals))) / pow(10, $decimals), $decimals, $decimalpoint, $seperator);
        }
        if ($currency_positions == 'right') {
            return number_format(floor(($price * pow(10, $decimals))) / pow(10, $decimals), $decimals, $decimalpoint, $seperator) . '' . $currency;
        }
        if ($currency_positions == 'right_with_space') {
            return number_format(floor(($price * pow(10, $decimals))) / pow(10, $decimals), $decimals, $decimalpoint, $seperator) . ' ' . $currency;;
        }
        return number_format(floor(($price * pow(10, $decimals))) / pow(10, $decimals), $decimals, $decimalpoint, $seperator);
    }
    /**
     * Display price with convert symbol
     * @param Double $price
     * @param String $recipients string or price
     */
    public static function ConvertPrice($price)
    {
        return \Utils::displayPrice($price,config('app_settings.currency_symbol.value'),config('app_settings.number_of_decimals.value'),config('app_settings.thousand_separator.value'),config('app_settings.decimal_separator.value'),config('app_settings.currency_position.value'));
    }


}