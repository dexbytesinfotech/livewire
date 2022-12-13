<?php

namespace App\Http\Livewire\Tags;

use Livewire\Component;
use App\Models\Tags\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends Component
{   
    use AuthorizesRequests;
    
    public Tag $tag;

    protected function rules(){
        return [
            'tag.title'    => 'required|string|max:75',
            'tag.status'   => 'nullable|between:0,1',
        ];
    }

    public function mount($id) {

        $this->tag = Tag::find($id);
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit(){

        $this->validate();
        $this->tag->update();

        return redirect(route('product-tag-management'))->with('status', 'Tag successfully updated.');
    }

    public function render()
    {
        return view('livewire.tags.edit');
    }
}
