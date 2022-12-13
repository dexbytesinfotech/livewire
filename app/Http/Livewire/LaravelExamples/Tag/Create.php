<?php

namespace App\Http\Livewire\LaravelExamples\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    public $name='';
    public $color='';

    protected $rules=[

        'name' => 'required|max:255|unique:tags,name',
        'color' =>'required',

    ];


    public function store(){

        $this->validate();

        Tag::create([
            'name' => $this->name,
            'color' =>$this->color,
        ]);

        return redirect(route('tag-management'))->with('status','Tag successfully created.');
    }


    public function render()
    {
        $this->authorize('manage-items', User::class);
        return view('livewire.laravel-examples.tag.create');
    }
}
