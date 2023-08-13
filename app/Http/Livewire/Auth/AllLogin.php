<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Models\Stores\Store;
use Illuminate\Validation\ValidationException;

class AllLogin extends Component
{
    public $email='';
    public $password='';

    protected $rules= [
        'email' => 'required',
        'password' => 'required'
    ];

    public function render()
    {
        return view('livewire.auth.all-login');
    }


    public function store()
    {
        $attributes = $this->validate();
    
        if (! auth()->attempt($this->credentials($attributes))) {
            return back()->with('status', "Your provided credentials could not be verified.");
        }

        $user = User::with(['roles', 'store'])->find(auth()->user()->id);
      

        if(!$user->status) {
            return back()->with('status', "Your account has been disabled, please see your system administrator");
        }

    
        session()->regenerate(); 
 
       return redirect()->route('dashboard');
    }
 
    protected function message($user)
    {
        $message = "";
        switch ($user->application_status) {
            case 'rejected':
                $message = 'Your application has been rejected, Please contact to administrator';
                break;
            case 'waiting':
                $message = 'Your application has been submitted and pending approval by administrator administrator or moderator';
                break;
            case 'suspended':
                $message = 'Your account has been suspended, Please contact to administrator';
                break;
            default:
                $message = '';
                break;
        }

        return $message;
    }



    protected function credentials($attributes) {

          if(is_numeric($attributes['email'])){
            return ['phone'=> $attributes['email'], 'password'=> $attributes['password']];
          }else{
            return ['email'=> $attributes['email'], 'password'=> $attributes['password']];
          }          
    }



}
