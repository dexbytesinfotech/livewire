<?php

namespace App\Http\Livewire\Faq;

use App\Models\Faq\Faq;
use App\Models\Faq\FaqCategory;
use App\Models\Roles\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Models\Faq\FaqTranslation;
class Edit extends Component
{
    public Faq $faq;
    public $faq_category ;
    public $role;
    public $descriptions = '';
    use AuthorizesRequests;
    public $lang = '';
    public $languages = '';

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
        //  Faq translate
        $this->lang = request()->ref_lang;
        $this->languages = request()->language;
        $this->faq->title = isset($this->faq->translate($this->lang)->title) ?  $this->faq->translate($this->lang)->title: $this->faq->translate(config('app.locale'))->title;
        $this->faq->descriptions = isset($this->faq->translate($this->lang)->descriptions) ? $this->faq->translate($this->lang)->descriptions : $this->faq->translate(config('app.locale'))->descriptions;
        //  Faq translate

         $this->faq_category = FaqCategory::all();
         $this->role = Role::all();
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function saveForm()
    {   
        $descriptions=$this->descriptions;
            if ($descriptions == '<p><br></p>'){
                $this->$descriptions = '';
            }
         $this->validate();

    }

    public function edit(){
        $this->validate();   
        $this->faq->update();
        return redirect(route('faq-management'))->with('status',__('faq.Faq successfully updated'));
    }

    public function editTranslate()
    {  
        $descriptions =$this->faq->descriptions;

        if ($descriptions == '<p><br></p>'){
            $this->faq->descriptions = '';
        }

        $request =  $this->validate([
            'faq.title' => 'required',
            'faq.descriptions' => 'required',
        ]);

        $data = [
            $this->lang => $request['faq']
        ];
        $faq = Faq::findOrFail($this->faq->id);
        $faq->update($data);

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Faq successfully updated.']);
    }


    public function render()
    {
        if ($this->lang != app()->getLocale()) {
            return view('livewire.faq.edit-language');
        }
        return view('livewire.faq.edit');
    }
}
