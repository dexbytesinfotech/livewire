<?php

namespace App\Http\Livewire\UserManagement;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Worlds\Country;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use App\Events\InstantMailNotification;
use Mail;

class Create extends Component
{

    use WithFileUploads;
    use AuthorizesRequests;


    public $roles;
    public $picture;
    public $email='';
    public $phone='';
    public $first_name ='';
    public $last_name = '';
    public $password='';
    public $role_id='';
    public $passwordConfirmation='';
    public $countries;
    public $country_code = '';
    public $role = '';
    

    protected $queryString = ['role'];

    protected function rules(){
        $this->password = trim($this->password);

        return [
            'email' => 'email|required|unique:App\Models\User,email',
            'first_name' =>'required|regex:/^[a-zA-Z ]+$/|min:3',
            'last_name' =>'required|regex:/^[a-zA-Z ]+$/|min:3',
            'phone' =>'required|numeric|digits_between:8,10|phone',
            'password' => 'required|min:7',
            'passwordConfirmation' => 'required|min:7|same:password',
            'role_id' => 'required|exists:Spatie\Permission\Models\Role,name',
            'country_code' => 'required',
        ];
    } 

    protected $messages = [
        'passwordConfirmation.required' => 'The confirm password field is required',
        
       
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
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'phone' => $this->phone,
                'country_code' => $this->country_code,
                'password' => $this->password,           
            ]);
        if($this->role_id){
            $user->assignRole(explode(',', $this->role_id));     
        }

         $latestUser = User::latest()->first();

        if($latestUser) {
            event(new InstantMailNotification($latestUser->id, [
                "code" =>  'forget_password',
                "args" => [
                    'name' => $latestUser->name,
                ]
            ]));
        }
        return redirect(route('user-management'))->with('status',__('User successfully created.'));
    }


    public function render()
    {
        return view('livewire.user-management.create');
    }
}
