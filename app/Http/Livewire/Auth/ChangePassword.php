<?php

namespace App\Http\Livewire\Auth;
use App\Models\User;
use App\Models\Users\PasswordReset;
use App\Models\Users\VerificationOtp;
use Livewire\Component;

class ChangePassword extends Component
{
    public $newPassword;
    public $confirmPassword;
    public $userId ="";

    protected $rules = [
        'newPassword' => 'required|min:7',
        'confirmPassword' =>'required|min:7|same:newPassword',
    ];

    public function messages() {
      return [
        "confirmPassword.same" => __('account.New Password and Confirm Password Field do not match'),
      ];

    }

    public function mount($user_id) {
        $this->userId = $user_id;
    }

    public function changePassword() {
        $this->validate();
        if($this->userId) {
            $user = User::findorFail($this->userId);
            $user->password = $this->newPassword;
            $user->save();
            VerificationOtp::where('user_id', $user->id)->delete();
            PasswordReset::where('email', $user->email)->delete();
            $this->reset(['newPassword', 'confirmPassword']);
            return redirect(route('login'))->with(['status'=> __('account.Password successfully updated')]);
        }
    }
   
    public function render()
    {
        return view('livewire.auth.change-password');
    }
}
