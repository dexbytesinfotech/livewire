<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use App\Models\Posts\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{   
    use AuthorizesRequests;
    public $title='';
    public $content='';
    public $status= '';

    protected $rules = [
        'title'    => 'required|max:255|string',
        'content'  => 'required|string|max:1000',
        'status'   => 'in:draft,published,unpublished',
    ];

    public function updated($propertyName) {
        
        $this->validateOnly($propertyName);

    } 

    public function store() {
        $this->validate();
        Post::create([
            'user_id'   => auth()->user()->id,
            'title'     => $this->title,
            'content'   => $this->content,
            'status'    => $this->status ? $this->status:'draft',
            'post_type' => "page",
        ]);
        return redirect(route('page-management'))->with('status',__('pages.Page successfully created'));
    }

    public function render()
    {
        return view('livewire.page.create');
    }
}
