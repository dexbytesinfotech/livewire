<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Models\Stores\Store;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{
    public $email='';
    public $password='';

    protected $rules= [
        'email' => 'required',
        'password' => 'required'
    ];

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function mount() {

        if (Auth::check())
        {
            return redirect()->intended('dashboard');

        }
    }

    public function store()
    {
        $attributes = $this->validate();
       

        $user = User::with(['roles', 'store'])->where(function ($query) use($attributes)
        {
            $query->orwhere('email',$attributes['email']);
            $query->orwhere('phone',$attributes['email']);
        })->first();
       
        if(!$user) {
            return back()->with('status',"Please provide correct phone or email.");
        }
        if (!Hash::check($this->password, $user->password)) {
            return back()->with('status', "Your provided credentials could not be verified.");
        }


        if(!$user->status) {
            return back()->with('status', "Your account has been disabled, please see your system administrator");
        }

        if(!$user->hasRole(['Provider', 'Admin'])) {
            return back()->with('status', "Please login with admin or provider privileges and try again");
        }

        if($user->hasRole('Provider')) {
            if(!isset($user->store->store_id)) {
                return back()->with('status', "Your store is not available, please see your system administrator");
            }

            $store = Store::where('id', $user->store->store_id)->first();

            if($store->application_status != 'approved'){
                return back()->with('status', $this->message($store));
            }

            if(!$store->status) {
                return back()->with('status', "Your store has been disabled, please see your system administrator");
            }
        }

        if (! auth()->attempt($this->credentials($attributes))) {
            return back()->with('status', "Your provided credentials could not be verified.");
        }

        session()->regenerate(); 

        if($user->hasRole('Provider')) {
            session(['profile' => $user->toArray(), 'store' => $store->toArray(), 'store_name' => $store->name, 'store_id' => $user->store->store_id]);
        }
     
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
