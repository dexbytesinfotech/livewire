<?php

namespace App\Http\Livewire\LaravelExamples\Category;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{

    use AuthorizesRequests;
    public $name='';
    public $description="";

    protected $rules=[

        'name' => 'required|unique:categories,name',
        'description' =>'required|min:5',
    ];

    public function store(){

        $this->validate();

        Category::create([
            'name' => $this->name,
            'description' =>$this->description,
        ]);

        return redirect(route('category-management'))->with('status','Category successfully created.');
    }

    public function render()
    {
        $this->authorize('manage-items', User::class);
        return view('livewire.laravel-examples.category.create');
    }
}
