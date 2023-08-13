<?php

namespace App\Http\Livewire\Auth;
use App\Models\Users\VerificationOtp;
use Livewire\Component;
use Carbon\Carbon;


class VerifyOtp extends Component
{
  public $otp;
  public $token;

  protected $rules= [
    'otp' => 'required|numeric|digits:6|exists:verification_otps',
  ];

  public function messages() {
    return [
    'otp.exists' => __('account.You have entered wrong otp.'),
    ];
  }

  public function mount($token) {
    $this->token =  $token;             
  }

  public function verifyOtp() {
    
    $this->validate();
    $verificationOtp = VerificationOtp::where('otp',$this->otp)->latest()->first();
    if(!$verificationOtp){
        return back()->with('status',__('account.You have entered wrong otp.'));
    }else {
      
      $now = Carbon::now();
      if($verificationOtp && $now->isAfter($verificationOtp->expire_at)){
        return redirect(route('login'))->with('status', __('account.The Otp is expired.Please regenrate the reset password link.'));
      }

      return redirect()->route('change-password', ['user_id' => $verificationOtp->user_id,'token'=>$this->token]);

    }
    
  }

    public function render()
    {
        return view('livewire.auth.verify-otp');
    }
}
