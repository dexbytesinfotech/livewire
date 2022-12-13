<?php

namespace App\Http\Livewire\LaravelExamples\Roles;

use Livewire\Component;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{
    use AuthorizesRequests;

    public $name = '';
    public $description = '';

    protected $rules = [

        'name' => 'required|max:255|unique:roles,name',
        'description' =>'required|min:5',
    ];

    public function store(){

        $this->validate();

        Role::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        return redirect(route('role-management'))->with('status','Role successfully created.');
    }


    public function render()
    {
        $this->authorize('manage-users', User::class);

        return view('livewire.laravel-examples.roles.create');
    }
}
