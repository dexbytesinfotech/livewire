<?php

namespace App\Models;

use App\Models\Sms\Twillo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Util extends Model
{
    use HasFactory;


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
    /**
     * Generate ramdom OTP when SMS send is enable
     * @param String $otp int
     */
    public static function generateOTP()
    {

        if (!config('app_settings.enable_sms_notifications.value')) {
            return 1234;
        }

        return rand(1000,9999);
    }


     /**
     * Generate ramdom OTP when SMS send is enable
     * @param String $otp int
     */
    public static function sendMessage($mobileNumber, $message = '')
    {
        if(empty($mobileNumber)) return false;

        $smsChannel = config('sms.default');
        $result = "";
        switch ($smsChannel) {
            case "twillo":
                $result = Twillo::sendMessage($mobileNumber, $message);
                break;
            default:
          }

        return $result;
    }


}
