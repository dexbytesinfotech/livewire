<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Notifications\ResetPassword;
use App\Models\User;
use App\Models\Users\PasswordReset;
use App\Models\Users\VerificationOtp;
use App\Models\Util;
use Illuminate\Notifications\Notifiable;
use App\Events\InstantMailNotification;
use Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;


class ForgetPassword extends Component
{
    use Notifiable;

    public $email='';
    
    protected $rules = [
        'email' => 'required',
    ];

    public function messages() {
        return [
        'email.required' => __('account.The Email/Mobile Number field is required.'),
        ];
    }

    public function render()
    {
        return view('livewire.auth.forget-password');
    }


    public function routeNotificationForMail() {
        return $this->email;
    }

    public function show(){

        if(env('IS_DEMO')){
            return back()->with('demo', __("account.You are in a demo version, you can't reset the password"));
        }
        else{

        $attributes = $this->validate();

        $user = User::with(['roles'])->where(function ($query) use($attributes) {
                $query->orwhere('email',$attributes['email']);
                $query->orwhere('phone',$attributes['email']);
                })->first();

        if (!$user) {
            if(is_numeric($attributes['email'])) {
                return redirect()->back()->with(['email' => __('account.Phone number does not exist.')]);
            } else {
                return redirect()->back()->with(['email' => __('account.Email id does not exist.')]);
            }
        }

            if($user){
                $role = $user->getRoleNames()->implode(",") ;
                if($role=="Admin"){
                  $token = Str::random(40);
                  $domainUrl = route('otp-verification',['token'=> $token]);
                               
                  PasswordReset::updateOrCreate([
                       'email'=> $user->email,
                       ],[
                        'email' => $user->email,
                        'token' => $token,
                        'created_at' => carbon::now()->addMinutes(5),
                   ]);

                   VerificationOtp::where('user_id', $user->id)->delete();

                  $verificationCode =  $this->generateEmailOtp($user->email);

                    event(new InstantMailNotification($user->id, [
                        "code" =>  'forget_password',
                        "args" => [
                            'name' => $user->name,
                            'url'  => $domainUrl,
                            'otp'  => $verificationCode->otp,
                        ]
                    ]));

                    return back()->with('status', __("account.We have emailed your password reset link/OTP!"));

                } else {
                    
                    if($user->phone) {
                        $otp = Util::generateOTP($user->phone);

                        $message = "Dear User, Your reset password Otp is :". $otp;

                        $sendOtp = Util::sendMessage($user->phone, $message);

                        if($sendOtp) {
                            return redirect()->route('otp-verification');
                        }
                    
                    }

                    return back()->with('status', __("account.We have sent an otp on your registered mobile number!."));
                
                }
              
            } else {
                return back()->with('email', __("account.Please enter correct login id."));
            }

         
     }
    }

    public function generateEmailOtp($email)
    {   

        $user = User::where('email',$email)->first();

        # User Does not Have Any Existing OTP
        $verificationOtp = VerificationOtp::where('user_id', $user->id)->latest()->first();

        $now = Carbon::now();

        if($verificationOtp && $now->isBefore($verificationOtp->expire_at)){
            return $verificationOtp;
        }

        // Create a New OTP
        return VerificationOtp::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(5)
        ]);
    }
}
