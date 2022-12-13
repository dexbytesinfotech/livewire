<?php

namespace App\Http\Livewire\Faq;

use App\Models\Faq\Faq;
use App\Models\Faq\FaqCategory;
use App\Models\Roles\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    public Faq $faq;
    public $faq_category ;
    public $role;
    public $descriptions = '';
    use AuthorizesRequests;


    protected function rules(){

        return [
            'faq.title' => 'required',
            'faq.descriptions' => 'required',
            'faq.status' => 'nullable|between:0,1',
            'faq.role_type' => 'nullable',
        ];
    }

    public function mount($id){

         $this->faq = Faq::find($id);
         $this->faq_category = FaqCategory::all();
         $this->role = Role::all();
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function saveForm()
    {
        $descriptions =$this->descriptions;
            if ($descriptions == '<p>b</p>'){
                $this->$descriptions = 'cannot send empty value';
            }
        $this->validate();
        
    }

    public function edit(){
        $this->validate();
        $this->faq->update();

        return redirect(route('faq-management'))->with('status','Faq successfully updated.');
    }

    public function render()
    {
        
        return view('livewire.faq.edit');
    }
}
