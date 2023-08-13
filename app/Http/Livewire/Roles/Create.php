<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{
    use AuthorizesRequests;
 
    public $name = '';
    public $content = '';
    public $permissions;
    public $selectedPermissions = [];

    protected $rules = [
        'name'    => 'required|max:255|unique:Spatie\Permission\Models\Role,name',
        'content' =>'nullable|min:5',
        'selectedPermissions' => 'nullable',
    ];

    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    public function mount() {
        $this->permissions = Permission::where("guard_name", "=", "web")->get();
    }


    public function store() {

       $validatedData = $this->validate();
       $role = Role::create($validatedData);
       $role->syncPermissions($this->selectedPermissions);

        return redirect(route('role-management'))->with('status', __('role.Role successfully created.'));
    }


    public function render()
    {
        return view('livewire.roles.create');
    }
}
