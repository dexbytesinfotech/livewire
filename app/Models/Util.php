<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Util extends Model
{
    use HasFactory;

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */
    public static function LocationUtil($query, $distance,$radius,$is_data = false)
    {
        try
        {
            // [$acos,$latitude, $longitude, $latitude]
            if ($is_data) {
                $is_data = '*,';
            }
            $locationFilter = $is_data."( ? * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?)) + sin( radians(?) ) * sin( radians( latitude ) ) )  )  AS distance";

            // Location Filter with lat long
            $query->selectRaw($locationFilter, $distance);
            // $query->having("distance", "<", $radius);

            return $query;
        }
        catch (Exception $e)
        {
            return 'Error: ' . $e->getMessage();
        }
    }

// Get Location Beetween Kilometer
    public static function GetBetweenDistance($orgins=null)
    {
    try {

    // 'origins' => '22.727299,75.888191',
    // 'destinations' => '22.96,76.05',
        $auth_token = config('geolocation.access_key');
        $buffer_time = config('app_settings.delivery_time.value');
        $max_time = config('app_settings.location_failed_time.value');

        if (empty($auth_token)) {
            return ($max_time+$buffer_time);
        }
        if (!is_array($orgins) || empty($orgins)) {
            return ($max_time+$buffer_time);
        }
        $data = $orgins;
        $data['key'] = $auth_token;
        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', $data);
        if ($response['status'] == 'OK') {
            if (isset($response['rows'][0]['elements'][0]['duration']['value'])) {
               return ($buffer_time+gmdate("i", $response['rows'][0]['elements'][0]['duration']['value']));
            }
            return ($max_time+$buffer_time);
        }
        return ($max_time+$buffer_time);
    } catch (Exception $e) {
        return 0;
    }
    }


    //
    public static function RadiusFinder($query)
    {
        $radius = config('app_settings.delivery_distance.value');
        switch (env('DB_CONNECTION')) {
            case 'pgsql':
                $query->where("distance", "<", $radius);
                break;
            case 'mysql':
                $query->having("distance", "<", $radius);
                break;

            default:
                return;
            break;
        }
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
        return Util::displayPrice($price,config('app_settings.currency_symbol.value'),config('app_settings.number_of_decimals.value'),config('app_settings.thousand_separator.value'),config('app_settings.decimal_separator.value'),config('app_settings.currency_position.value'));
    }
}
