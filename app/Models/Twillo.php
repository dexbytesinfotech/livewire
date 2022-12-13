<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;

class Twillo extends Model
{
    use HasFactory;

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */
    public function sendMessage($message, $recipients)
    {
        try
        {
            $account_sid = config('sms.twillo.twilio_sid');
            $auth_token = config('sms.twillo.twilio_auth_token');
            $twilio_number = config('sms.twillo.twilio_number');

            $client = new Client($account_sid, $auth_token);
            $message = $client->messages->create($recipients, 
                    ['from' => $twilio_number, 'body' => $message] );

            return $message->id;
        }
        catch (Exception $e)
        {
            return 'Error: ' . $e->getMessage();
        }
    }

}
