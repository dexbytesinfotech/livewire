<?php

namespace App\Http\Livewire\Faq;

use App\Models\Faq\Faq;
use App\Models\Faq\FaqCategory;
use App\Models\Roles\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    public function render()
    {

        return view('livewire.faq.create');
    }

    use AuthorizesRequests;
    public $faq='';
    public $title='';
    public $descriptions='';
    public $status= '';
    public $role_type='';
    public $faq_category ;
    public $role = '';

    protected $rules=[
        'title' => 'required|string',
        'descriptions' => 'required|max:1000',
        'status' => 'nullable|between:0,1',
        'role_type' => 'required',      
    ];

    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    public function mount(){
        $this->faq_category = FaqCategory::all();
        $this->role = Role::all();
    }
    public function saveForm()
    {
        $descriptions =$this->descriptions;
            if ($descriptions == '<p>b</p>'){
                $this->$descriptions = 'cannot send empty value';
            }
        $this->validate();
        
    }

    public function store(){

        $this->validate();

        $faq = Faq::create([
            'status'        => $this->status ? 1:0,
            'faq_category_id'=> 1,
            'role_type'     => $this->role_type,
            'title'         => $this->title,
            'descriptions'  => $this->descriptions,
    ]);

 
        return redirect(route('faq-management'))->with('status',__('faq.Faq successfully created'));
    }

}
