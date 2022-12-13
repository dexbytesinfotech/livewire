<?php

namespace App\Http\Livewire\LaravelExamples\Items;

use App\Models\Category;
use App\Models\Faq\Faq;
use App\Models\Item;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $categories;
    public $tags;
    public $name='';
    public $category_id='';
    public $description='';
    public $picture;
    public $tags_id=[];
    public $status='';
    public $options=[];
    public $date;
    public $showOnHomepage = false;

    protected $rules =[
        'title' => 'required',
        'descriptions' => 'required|max:100',
        'status' => 'nullable|integer|between:0,1',
        'role_type' => 'nullable',
        'faq_category_id' => 'required|integer|exists:App\Models\Faq\FaqCategory,id'

    ];

    public function mount(){
         $this->categories= Category::get(['id','name']);
         $this->tags = Tag::get(['id','name']);
    }


    public function store( Faq $faq){



        try
        {
            $faqResource = $faq->create($this->validate());
            //return $this->sendResponse(new FaqResource($faqResource), Response::HTTP_CREATED);
            session()->flash('message', 'Faq Create sucsessfully');
            return redirect(route('item-management'))->with('status','Item successfully created.');

        } catch (\Exception $e) {
            session()->flash('message', 'Error');
        }

        // sort($this->tags_id);
        // $item->tag()->sync($this->tags_id, false);


    }

    public function render()
    {
        $this->authorize('manage-items', User::class);

        return view('livewire.laravel-examples.items.create');
    }
}
