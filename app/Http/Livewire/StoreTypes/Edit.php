<?php

namespace App\Http\Livewire\StoreTypes;
use App\Models\Stores\StoreType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{  
    use AuthorizesRequests;
    public StoreType $StoreType;
    public $lang = '';
    public $languages = '';

    protected function rules() {
        $StoreType = isset($this->StoreType->translate($this->lang)->id)  ? ','.$this->StoreType->translate($this->lang)->id : null;
        $this->StoreType->name = trim($this->StoreType->name);

        return [
            'StoreType.name'   => 'required|unique:App\Models\Stores\StoreTypeTranslation,name'.$StoreType,
            'StoreType.status' => 'nullable|between:0,1',
        ];
    }

    public function mount($id) {

        $this->StoreType = StoreType::find($id);
        //store type translate
        $this->lang = request()->ref_lang;
        $this->languages = request()->language;

        $this->StoreType->name = isset($this->StoreType->translate($this->lang)->name) ?  $this->StoreType->translate($this->lang)->name: $this->StoreType->translate(app()->getLocale())->name;
      
        //store type translate

    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit() {

        $this->validate();
        $this->StoreType->update();

        return redirect(route('store-type-management'))->with('status', 'Store type successfully updated.');

    }

    public function editTranslate()
    {
        $StoreType = isset($this->StoreType->translate($this->lang)->id)  ? ','.$this->StoreType->translate($this->lang)->id : null;
        $request =  $this->validate([
            'StoreType.name' => 'required|unique:App\Models\Stores\StoreTypeTranslation,name'.$StoreType,
        ]);

        $data = [
            $this->lang => $request['StoreType']
        ];
        $StoreType = StoreType::findOrFail($this->StoreType->id);
        $StoreType->update($data);

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Store type successfully updated.']);
    }

    public function render()
    {
        
        if ($this->lang != app()->getLocale()) {
            return view('livewire.Store-types.edit-language');
        }
        return view('livewire.Store-types.edit');
    }

}
