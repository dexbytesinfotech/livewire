<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends Component
{
    use AuthorizesRequests;

    public Role $role;
    protected $defaultRoles = ['Admin', 'Provider', 'Driver', 'Customer', 'Unverified'];
    public $permissions;
    public $selectedPermissions=[];
    
    protected function rules(){
        return [
            'role.name' => 'required|unique:Spatie\Permission\Models\Role,name,'.$this->role->id,
            'role.content' => 'nullable|min:5',
            'selectedPermissions' =>'nullable',
        ];
    }

    public function mount($id) {

        $this->role = Role::find($id);
        $this->permissions = Permission::where("guard_name", "=", "web")->get();
        $this->selectedPermissions =$this->role->getAllPermissions()->pluck('id', 'id')->toArray();

    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit() {

        if($this->selectedPermissions)
        {   // remove unchecked values that comes with false assign it
            $this->selectedPermissions = Arr::where($this->selectedPermissions, function ($value) {
                return $value;
            });
        }
        
        $this->validate();
        $this->role->update();
        $this->role->syncPermissions($this->selectedPermissions);

        return redirect(route('role-management'))->with('status', 'Role successfully updated.');
    }


    public function render()
    {
        return view('livewire.roles.edit');
    }
}
