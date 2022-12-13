<?php

namespace App\Http\Livewire\StoreTypes;
use App\Models\Stores\StoreType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{  
    use AuthorizesRequests;
    public StoreType $storeType;

    protected function rules() {
        return [
            'storeType.name'   => 'required|unique:App\Models\Stores\StoreType,name,'.$this->storeType->id,
            'storeType.status' => 'nullable|between:0,1',
        ];
    }

    public function mount($id) {

        $this->storeType = StoreType::find($id);

    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit() {

        $this->validate();
        $this->storeType->update();

        return redirect(route('store-type-management'))->with('status', 'Store type successfully updated.');

    }

    public function render()
    {
        return view('livewire.store-types.edit');
    }

}
