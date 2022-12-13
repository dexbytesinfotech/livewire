<?php

namespace App\Http\Livewire\LaravelExamples\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{

    public Tag $tag;
    use AuthorizesRequests;
    
    protected function rules(){

        return [
            'tag.name' => 'required|unique:tags,name,'.$this->tag->id,
            'tag.color' =>'required',
        ];
    }

    public function mount($id){

        $this->tag = Tag::find($id);
    }

    public function update(){
        
        $this->validate();

        $this->tag->update();

        return redirect(route('tag-management'))->with('status','Tag successfully updated.');
    }

    public function render()
    {
        $this->authorize('manage-items', User::class);
        return view('livewire.laravel-examples.tag.edit');
    }
}
