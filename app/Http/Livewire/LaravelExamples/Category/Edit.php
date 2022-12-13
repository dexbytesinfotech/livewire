<?php

namespace App\Http\Livewire\LaravelExamples\Category;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    public Category $category;
    use AuthorizesRequests;

    protected function rules(){

        return [        
            'category.name' => 'required|max:255|unique:categories,name,'.$this->category->id,
            'category.description' =>'required|min:5',
        ];


    }

    public function mount($id){

        $this->category = Category::find($id);
    }

    
    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function update(){
        
        $this->validate();

        $this->category->update();

        return redirect(route('category-management'))->with('status', 'Category successfully updated.');
    }

    public function render()
    {
        $this->authorize('manage-items', User::class);
        return view('livewire.laravel-examples.category.edit');
    }
}
