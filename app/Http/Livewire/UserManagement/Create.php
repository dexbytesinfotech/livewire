<?php

namespace App\Http\Livewire\UserManagement;

use App\Models\Driver\UserDriver;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Worlds\Country;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{

    use WithFileUploads;
    use AuthorizesRequests;


    public $roles;
    public $picture;
    public $email='';
    public $phone='';
    public $name ='';
    public $password='';
    public $role_id='';
    public $passwordConfirmation='';
    public $countries;
    public $country_code = '';
    public $role = '';
    

    protected $queryString = ['role'];

    protected $rules = [
        'email' => 'required|email|unique:App\Models\User,email',
        'name' =>'required',
        'phone' =>'required|numeric|min:8|unique:App\Models\User,phone',
        'password' => 'required|min:7',
        'passwordConfirmation' => 'required|min:7|same:password',
        'role_id' => 'required|exists:Spatie\Permission\Models\Role,name',
       // 'country_code' => 'required',
    ];

    public function mount() {

        $this->roles = Role::where('guard_name', 'web')->where('status', 1)->get(['id','name']);
        $this->countries = Country::all();
        $this->country_code = Country::where('is_default', 1)->value('country_code');
        $this->role_id = ucfirst($this->role);
 
        if(Role::where('name', $this->role_id)->doesntExist()) {
            $this->role_id = '';
            $this->role = '';
        }      
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    public function store(){

        $this->validate();

        $user = User::create([
                'email' => $this->email,
                'name' => $this->name,
                'phone' => $this->country_code.''.$this->phone,
                'country_code' => $this->country_code,
                'password' => $this->password,           
            ]);
            if($this->role_id == 'Driver')
            {
                UserDriver::create([
                    'user_id' => $user->id,
                    'is_live' => 0
                    ]);        
            }

        if($this->role_id){
            $user->assignRole(explode(',', $this->role_id));     
        }
      
        return redirect(route('user-management'))->with('status','User successfully created.');
    }


    public function render()
    {
       // $this->authorize('manage-users', User::class);
        return view('livewire.user-management.create');
    }
}
