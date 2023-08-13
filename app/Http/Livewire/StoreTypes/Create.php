<?php

namespace App\Http\Livewire\StoreTypes;

use Livewire\Component;
use App\Models\Stores\StoreType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{    
    use AuthorizesRequests;

    public $name ;
    public $status;

    protected function rules(){
        $this->name = trim($this->name);
      return  [
            'name'   => 'required|max:255|unique:App\Models\Stores\StoreTypeTranslation,name',
            'status' => 'nullable|between:0,1',
        ];
    }


    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    public function store() {
        $this->validate();
        
        StoreType::create([
            'name'   => $this->name,
            'status' => $this->status ? 1 : 0,
        ]);

        return redirect(route('store-type-management'))->with('status','Store type successfully created.');
    }

    public function render()
    {
        return view('livewire.store-types.create');
    }
}
