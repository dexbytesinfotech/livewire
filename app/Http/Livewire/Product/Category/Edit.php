<?php

namespace App\Http\Livewire\Product\Category;

use App\Models\Products\ProductCategories;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    public ProductCategories $category;
    public $image;

    protected function rules(){
        return [
            'category.name' => 'required|max:255|unique:product_categories,name,'.$this->category->id,
            'category.description' => 'required|max:1000',
            'category.status' => 'nullable|between:0,1',
        ];
    }

    public function mount($id) {

        $this->category = ProductCategories::find($id);
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit(){

        $this->validate();
        if ($this->image){
            $this->validate([
                'image' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096',
            ]);
            $currentAvatar = ProductCategories::find($this->category->id)->image;
            if($currentAvatar !== 'default-food-avatar.jpg'){
                unlink(storage_path('app/public/'.$currentAvatar));
                $this->category->update([
                    'image' => $this->image->store('ProductCategory', 'public')
                ]);
            }
            else{
                $this->category->update([
                    'image' => $this->image->store('ProductCategory', 'public')
                ]);
            }
        }
        $this->category->update();

        return redirect(route('product-category-management'))->with('status', 'Product Category successfully updated.');
    }



    public function render()
    {
        return view('livewire.product.category.edit');
    }
}
