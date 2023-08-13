<?php

namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\TwilioException;
use Exception;

class Twillo extends Model
{
    use HasFactory;

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param Number $recipients string or array of phone number of recepient
     * @param String $message Body of sms
     */
    public static function sendMessage($recipients,$message)
    {
        $request = array();
        if (!config('app_settings.enable_sms_notifications.value')) {
            return true;
        }
        try
        {
            $request['phone'] = $recipients;
            $request['discription'] = $message;
            $account_sid = config('sms.twillo.twilio_sid');
            $auth_token = config('sms.twillo.twilio_auth_token');
            $twilio_number = config('sms.twillo.twilio_number');

            $client = new Client($account_sid, $auth_token);
            $message = $client->messages->create((string)  '+'.$recipients,
                    ['from' => $twilio_number, 'body' => $message] );
            $request['response_code'] = $message;
            $request['status'] = true;
        }
        catch (TwilioException $e)
        {
            $request['status'] = false;
            $request['response_code'] = $e->getMessage();
        }
        SmsNotification::create($request);
    }

}
