<?php

namespace App\Http\Livewire\LaravelExamples\UserManagement;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{

    use WithFileUploads;
    use AuthorizesRequests;


    public $roles;
    public $picture;
    public $email='';
    public $name ='';
    public $password='';
    public $role_id='';
    public $passwordConfirmation='';

    protected $rules = [
        'email' => 'required|email|unique:users,email',
        'name' =>'required',
        'password' => 'required|same:passwordConfirmation|min:7',
        'picture' => 'required|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
        'role_id' => 'required|exists:roles,id',
    ];

    public function mount() {

        $this->roles = Role::get(['id','name']);
    }

    public function store(){

        $this->validate();


        User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'picture' => $this->picture->store('profile', 'public'),
            'role_id' => $this->role_id,
        ]);

        return redirect(route('user-management'))->with('status','User successfully created.');
    }


    public function render()
    {
        $this->authorize('manage-users', User::class);
        return view('livewire.laravel-examples.user-management.create');
    }
}
