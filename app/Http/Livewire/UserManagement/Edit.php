<?php

namespace App\Http\Livewire\UserManagement;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Worlds\Country;

class Edit extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public User $user;
    public $roles;
    public $role_id; 
    public $countries = '';

    protected $listeners = [
        'getRoleIdForInput'
    ];

    protected function rules(){
        return [
            'user.email' => 'required|email|unique:App\Models\User,email,'.$this->user->id,
            'user.name' =>'required',
            'user.phone' =>'required|min:8|unique:App\Models\User,phone,'.$this->user->id,            
            'role_id' => 'required|exists:Spatie\Permission\Models\Role,name',
            'user.country_code' => 'required',
        ];
    }

    public function mount($id) {

        $this->user = User::find($id);
      
        $this->user->phone = substr($this->user->phone , +(strlen($this->user->country_code)));

        $this->roles = Role::where('guard_name', 'web')->where('status', 1)->get(['id','name']);
        $this->role_id  = Role::where('name', $this->user->getRoleNames()->implode(','))->pluck('name','name')->first() ;
        $this->countries = Country::all();
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    public function resetField(){
        $this->user->phone = substr($this->user->phone , (strlen($this->user->country_code)));
    }

    public function update(){
        
        $this->validate();
        $this->user->phone =  $this->user->country_code. $this->user->phone;
        
       // updateOrCreate(['store_id' => $store_id, 'key' => 'business_hours'], ['value'=> $business_hours]);

        if(!$this->user->hasRole($this->role_id)){
            $this->user->syncRoles(explode(',', $this->role_id));     
        }

        $this->user->save();

        $this->resetField();
        return redirect(route('user-management'))->with('status', 'User successfully updated.');
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function getRoleIdForInput($value){ 
        $this->role_id = $value;
    }

    public function render()
    {  
        return view('livewire.user-management.edit');
    }

  
}
