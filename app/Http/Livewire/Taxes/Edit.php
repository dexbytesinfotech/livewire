<?php

namespace App\Http\Livewire\Taxes;

use App\Models\Tax\Tax;
use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends Component
{   
    use AuthorizesRequests;
    public Tax $tax;

    protected function rules(){
        return [
            'tax.name'       => 'required|string|max:255|unique:App\Models\Tax\Tax,name',
            'tax.percentage' => 'required|numeric',
            'tax.status'     => 'nullable|between:0,1',
        ];
    }

    public function mount($id) {

        $this->tax = Tax::find($id);
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit(){

        $this->validate();
        $this->tax->update();

        return redirect(route('tax-management'))->with('status', 'Tax successfully updated.');
    }

    public function render()
    {
        return view('livewire.taxes.edit');
    }
}
