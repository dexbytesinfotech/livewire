<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Constants\MailsTypesListArray;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Storage;

class SendMailNotification extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var array
     */
    protected $variableValues = [];

    /**
     * @var string
     */
  /**
     * Create a new message instance.
     *
     * @param string $content
     * @param string $subject
     * @param array $data
     */
    public function __construct($code, $variableValues = [],$data = [])
    {   
        $this->code = $code;
        $this->variableValues = $variableValues;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fromName = config('app_settings.app_name.value');
        $fromAddress = config('app_settings.support_email.value');

        $mail_types = Arr::first(MailsTypesListArray::TypeArray, function ($value, $key) {
            return $value['code'] == $this->code;
        });
        $content = $this->Convert($mail_types);
        $subject = $this->replaceVariableValue(array_keys($this->variableValues), $mail_types['subject']);
        $email = $this
            ->from($fromAddress, $fromName)
            ->subject($subject)
            ->html($content);

        $attachments = Arr::get($this->data, 'attachments');
        if (!empty($attachments)) {
            if (!is_array($attachments)) {
                $attachments = [$attachments];
            }
            foreach ($attachments as $file) {
                $email->attach($file);
            }
        }

        if (isset($this->data['cc'])) {
            $email = $this->cc($this->data['cc']);
        }

        if (isset($this->data['bcc'])) {
            $email = $this->bcc($this->data['bcc']);
        }

        if (isset($this->data['replyTo'])) {
            $email = $this->replyTo($this->data['replyTo']);
        }
        return $email;
    }


    public function Convert($mail_types)
    {
        try {
            // timeout issue
            // if (config('app_settings.app_logo.value')) {
            //     $image = Storage::disk(config('app_settings.filesystem_disk.value'))->url(config('app_settings.app_logo.value'));
            //     $base64 = 'data:image/png;base64, '.base64_encode(file_get_contents($image));
            // }else{
            //     $base64 = 'data:image/png;base64, '.base64_encode(file_get_contents(asset('assets').'/img/logo-ct.png'));
            // }

        $this->variableValues["header"] = File::get(app()->langPath().'/mailer/en/header.tpl');
        $this->variableValues["footer"] = File::get(app()->langPath().'/mailer/en/footer.tpl');
        $this->variableValues['site_name'] = config('app_settings.app_name.value');
        $this->variableValues['site_url'] = config('app_settings.app_url.value');
        $this->variableValues['site_logo'] = "";
        $this->variableValues['site_title'] = config('app_settings.app_service_type.value');
        $this->variableValues['site_admin_email'] = config('app_settings.support_email.value');
        $this->variableValues['date_year'] = Carbon::now()->format('Y');
        $content = File::get(app()->langPath().'/mailer/'.app()->getLocale().'/'.$mail_types['code'].'.tpl');
        $contents = $this->replaceVariableValue(array_keys($this->variableValues), $content);
        return $contents;

    } catch (\Exception $e) {

    }
    }

     /**
     * @param array $variables
     * @param string $content
     * @return string
     */
    protected function replaceVariableValue(array $variables, string $content): string
    {
        foreach ($variables as $variable) {
            $keys = [
                '{{ ' . $variable . ' }}',
                '{{' . $variable . '}}',
                '{{ ' . $variable . '}}',
                '{{' . $variable . ' }}',
                '<?php echo e(' . $variable . '); ?>',
            ];

            foreach ($keys as $key) {
                $content = str_replace($key, $this->getVariableValue($variable), $content);
            }
        }
        return $content;
    }
    /**
     * @param string $variable
     * @param string $default
     * @return string
     */
    public function getVariableValue(string $variable, string $default = ''): string
    {
        return (string)Arr::get($this->variableValues, $variable, $default);
    }

}
