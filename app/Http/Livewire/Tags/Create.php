<?php

namespace App\Http\Livewire\Tags;

use Livewire\Component;
use App\Models\Tags\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{   
    use AuthorizesRequests;

    public $title = '';
    public $status = '';

    protected $rules = [
        'title'   => 'required|string|max:75',
        'status' => 'nullable|between:0,1',
    ];


    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    public function store(){

        $this->validate();

        Tag::create([
            'title'  => $this->title,
            'status' => $this->status ? 1:0,
            'type'   => "search",
        ]);

        return redirect(route('product-tag-management'))->with('status','Tag successfully created.');
    }

    public function render()
    {
        return view('livewire.tags.create');
    }
}
