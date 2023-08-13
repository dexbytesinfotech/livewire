<?php

namespace App\Listeners;

use App\Events\InstantMailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Mails\MailDeliveredMessage;
use Mail;
use App\Mail\SendMailNotification;
use Illuminate\Queue\InteractsWithQueue;
class SendInstantMailNotification implements ShouldQueue
{
    use InteractsWithQueue;

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
     * @param  \App\Events\InstantMailNotification  $event
     * @return void
     */
    public function handle(InstantMailNotification $event)
    {   
        
        if (!config('app_settings.enable_mail_notifications.value')) {
            return true;
        }

        if(config('app_settings.enable_slack_log_notifications.value')) {
            Log::channel('slack')->info('Instant:MailNotification - '.config('app.name'), [
                'userIds' => $event->userIds,
                'message' => $event->varable,
            ]);
       }
      
       if (gettype($event->userIds) == 'array') {
            $userIds = $event->userIds;
        }else{
            $userIds = array_filter(explode(',', $event->userIds));
        }
       $email = User::whereIn('id',$userIds)->pluck('email');
       $users = User::whereIn('id',$userIds)->get();

       $mail =  Mail::to($email)->send(new SendMailNotification($event->varable['code'],$event->varable['args']));
       $mails_store = [];
       foreach ($users as $index => $value) {
        $mail =
        [
            'user_id' => $value->id,
            'templtete_code' => $event->varable['code'],
            'name' => $value->name,
            'email' => $value->email,
            'subject' => "",
            'discription' => "",
            'message' => @json_encode($event->varable,true),
            'status' => true,
        ];
        array_push($mails_store,$mail);
       }
       if (!empty($mails_store)) {
        MailDeliveredMessage::insert($mails_store);
       }
    }
}
