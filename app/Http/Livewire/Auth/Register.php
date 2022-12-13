<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class Register extends Component
{

    public $name ='';
    public $email = '';
    public $password = '';
    public $phone= '';
    public $country_code;
    public $roles='';

    protected $rules=[
        'name' => 'required',
        'email' => 'required|email|unique:App\Models\User,email',
        'phone' => 'required|unique:App\Models\User,phone|numeric|digits_between:8,12',
        'country_code' => 'required|numeric|digits_between:2,4',
        'password' => 'required',
        'role_id' => 'required|exists:Spatie\Permission\Models\Role,id'
];


    public function store(){

        $attributes = $this->validate();
        dd($attributes);
        // $role_id =  $attributes->input('role_id');
        // $payload = $request->all();

        // unset($payload['role_id']);

        // $resource = $user->create($payload);

       $user =   User::create([
            'name'           => $this->name,
            'email'          =>$this->email,
            'phone'          => $this->phone,
            'country_code'   => $this->country_code,
            'password'       => $this->password,
            'role_id'        => $this->role_id
        ]);


        auth()->login($user);

        return redirect('laravel-examples/user-profile');
    }

    public function mount(){

        // if($request->role_id ){
        //     $resource->assignRole(explode(',',$request->role_id));
        // }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
