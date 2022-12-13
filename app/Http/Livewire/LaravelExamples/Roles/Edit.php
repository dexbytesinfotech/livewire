<?php

namespace App\Http\Livewire\LaravelExamples\Roles;

use Livewire\Component;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends Component
{
    use AuthorizesRequests;

    public Role $role;

    protected function rules(){
        return [
            'role.name' => 'required|unique:roles,name,'.$this->role->id,
            'role.description' => 'required',
        ];
    }

    public function mount($id) {

        $this->role = Role::find($id);
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit(){

        $this->validate();
        $this->role->update();

        return redirect(route('role-management'))->with('status', 'Role successfully updated.');
    }


    public function render()
    {
        $this->authorize('manage-users', User::class);
        return view('livewire.laravel-examples.roles.edit');
    }
}
