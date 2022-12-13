<?php

namespace App\Http\Livewire\Product\Category;

use App\Models\Products\ProductCategories;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
 
    public $image;
    public $name = '';
    public $status = '';
    public $description = '';

    protected $rules = [
        'image' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096',
        'name' => 'required|max:255|unique:product_categories,name',
        'description' => 'required|max:1000',
        'status' => 'nullable|between:0,1',
    ];


    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    public function store(){
        $validatedData = $this->validate();
        ProductCategories::create([
            'image' => $this->image->store('ProductCategory', 'public'),
            'name' => $this->name,
            'description' => $this->description,
            'status'=> $this->status ? 1:0,
       ]);
         
        return redirect(route('product-category-management'))->with('status','ProductCategory successfully created.');
    }



    public function render()
    {
        return view('livewire.product.category.create');
    }
}
