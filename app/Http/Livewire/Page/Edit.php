<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use App\Models\Posts\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends Component
{   
    use AuthorizesRequests;
    public Post $post;

    protected function rules(){
        return [
            'post.title'    => 'required|max:255|string',
            'post.content'  => 'required|string',
            'post.status'   => 'in:draft,published,unpublished',
        ];
    }

    public function mount($id) {

        $this->post = Post::find($id);
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit() {
       $this->validate();
        $this->post->update([
            'user_id'   => auth()->user()->id,
            'title'     => $this->post->title,
            'content'   => $this->post->content,
            'status'    => $this->post->status ? $this->post->status:'draft',
        ]);
        
       return redirect(route('page-management'))->with('status', 'Page successfully updated.');
    }

    public function render()
    {
        return view('livewire.page.edit');
    }
}
