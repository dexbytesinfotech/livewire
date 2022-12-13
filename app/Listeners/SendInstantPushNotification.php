<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Services\FCMService;
use App\Models\Push\PushDevice;
use App\Models\Push\PushMessage;
use Illuminate\Support\Facades\Log;
use App\Models\Push\PushUserMessage;
use App\Events\InstantPushNotification;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Push\PushDeliveredMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInstantPushNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\InstantPushNotification  $event
     * @return void
     */
    public function handle(InstantPushNotification $event)
    {
        if (isset($event->message['body']) && $event->message['body'] != '') {

            $sendAt = Carbon::now()->toDateTimeString();

            // prepare message data
            $messageData = [
                "app_name" => 'all',
                "send_to" => 'specific_users',
                "with_image" => 0,
                "is_silent" => 0,
                "title" => isset($event->message['title']) ? $event->message['title'] : '',
                "text" => isset($event->message['body']) ? $event->message['body'] : '',
                "send_at" => $sendAt,
                "status" => 'sent',
                "should_visible" =>  isset($event->message['should_visible']) ? $event->message['should_visible'] : 1,
            ];

            if (isset($event->message['data'])) {
                $messageData['action_value'] = json_encode($event->message['data']);
            }
            // create message entry
            $pushMessage = PushMessage::create($messageData);

            if (gettype($event->userIds) == 'array') {
                $userIds = $event->userIds;
            }else{
                $userIds = array_filter(explode(',', $event->userIds));
            }

            //get users devices
            $pushDevice = new PushDevice;
            $pushDevices  = $pushDevice->with('user')->whereIn('user_id', $userIds)
                ->whereNotNull('device_token_id')->where('status','active')
                ->get()->toArray();

            if (!empty($pushDevices)) {

                $deviceInfo = [];
                $firebaseToken = [];
                foreach ($pushDevices as $pushDevice) {
                    array_push($deviceInfo, [
                        'device_id' => $pushDevice['id'],
                        'device_uid' => $pushDevice['device_uid'],
                        'device_type' => $pushDevice['device_type'],
                        'user_id' => $pushDevice['user_id'],
                        'message_id' => $pushMessage['id'],
                    ]);
                    if ($pushDevice['user']['global_notifications']) {
                        array_push($firebaseToken, $pushDevice['device_token_id']);
                    }
                }

                // create message delivery entry
                if (!empty($deviceInfo)) {
                    PushDeliveredMessage::insert($deviceInfo);
                }
                // prepare data to send notification
                $data = [
                    "registration_ids" => $firebaseToken,
                    "notification" => [
                        "title" =>  $pushMessage->title,
                        "body" => $pushMessage->text,
                    ],
                ];

                if (isset($event->message['data']) && $event->message['data'] != '' && !empty($event->message['data'])) {
                    $data['data'] = $event->message['data'];
                }

                $data['data']['message_id'] = $pushMessage['id'];

               if(config('app_settings.enable_slack_log_notifications.value')) {
                    Log::channel('slack')->info('Instant:PushNotification - '.config('app.name'), [
                        'userIds' => $event->userIds,
                        'message' => $event->message,
                        'data' => $data,
                    ]);
               }

                //  send push notification
                $output = (new FCMService)->send($data);
                // update message status
                PushMessage::where('id', $pushMessage['id'])->update(['status' => 'sent']);

                foreach ($deviceInfo as $index => $deliveredMessage) {
                    $status = isset($output['results'][$index]['error']) ? 'fail' : 'deliver';
                    $data = PushDeliveredMessage::updateOrCreate(
                        [
                            'device_id' => $deliveredMessage['device_id'],
                            'user_id' => $deliveredMessage['user_id'],
                            'message_id' => $deliveredMessage['message_id']
                        ],
                        [
                            'status' => $status,
                            'error_msg' => ($status == 'fail') ? json_encode($output['results'][$index]['error']) : null,
                            'delivered_at' => ($status == 'deliver') ? Carbon::now()->toDateTimeString() : null,
                        ]
                    );
                }
            }
        }
    }
}
