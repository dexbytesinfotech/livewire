<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FCMService
{

    protected $url;
    protected $http;
    protected $headers;

    public function __construct()
    {
        $this->url = 'https://fcm.googleapis.com/fcm/send';
        $apiKey = config('fcm.server_api_key');

        $this->headers = [
            'Authorization' => 'key=' . $apiKey,
            'Content-Type' => 'application/json'
        ];
    }

    public function send($fcmNotification)
    {
        if(config('app_settings.enable_push_notifications.value')) {
            $fcmNotification['notification']['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';
            $fcmNotification['data']['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';

            $http = Http::withHeaders($this->headers)->post($this->url, $fcmNotification);
        }

        if(config('app_settings.enable_slack_log_notifications.value')) {
                Log::channel('slackNotification')->info("FCM Push Notification - ".config('app.name'), [
                    'Info' => ['request' => $fcmNotification, 'responce' => $http]
                ]);
        }

        return  $http->json();
    }
}
