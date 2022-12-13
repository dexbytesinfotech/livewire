<?php

namespace App\Http\Livewire\LaravelExamples\Items;

use App\Models\Category;
use App\Models\Item;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Item $item;
    public $categories;
    public $tags;
    public $picture;
    public $tags_id = [];


    protected function rules(){

        return[
            'item.name' => 'required|unique:items,name,'.$this->item->id,
            'item.category_id' =>'required|exists:categories,id',
            'item.description' => 'required',
            'tags_id' => 'required',
            'item.status' =>'required|in:published,draft,archive',
            'item.options' => 'required',
            'item.date' => 'required',
            'item.homepage'=>''
        ];
    }

    public function mount($id){

        $this->item = Item::find($id);
        $this->categories = Category::get(['id','name']);
        $this->tags = Tag::get(['id','name']);
        $this->tags_id = $this->getTags();

        if($this->item->options == null){
            $this->item->options = ["0","1","2"];
            $this->item->update([
                'item.options' => $this->item->options
            ]);
        }
    }

    public function getTags() {
        $idArray = [];
        foreach($this->item->tag as $tag) {
            array_push($idArray, $tag->id);
        }
        return $idArray;
    }

    public function update(){


        $this->validate();
        $this->item->update();
            

        if ($this->picture){
            
            $this->validate([
                'picture' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096',
            ]);

            $currentPicture = $this->item->picture;

            if ($currentPicture !=='pictures/img1.jpg' && $currentPicture !=='pictures/img2.jpg' && $currentPicture !=='pictures/img3.jpg'){
                unlink(storage_path('app/public/'.$currentPicture));
            }
            $this->item->update([
                'picture' => $this->picture->store('pictures', 'public')
            ]);
        }

        
        $this->item->tag()->detach();
        sort($this->tags_id);
        $this->item->tag()->sync($this->tags_id, false);

        return redirect(route('item-management'))->with('status','Item successfully updated.');
    }

    public function render()
    {
        $this->authorize('manage-items', User::class);

        return view('livewire.laravel-examples.items.edit');
    }
}
