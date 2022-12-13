<?php

namespace App\Http\Livewire\Taxes;

use App\Models\Tax\Tax;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{   
    use AuthorizesRequests;
    public $name;
    public $percentage;
    public $status='';

    protected $rules = [
        'name'       => 'required|max:255|string|unique:App\Models\Tax\Tax,name',
        'percentage' => 'required|numeric',
        'status'     => 'nullable|between:0,1',
    ];


    public function updated($propertyName) {

        $this->validateOnly($propertyName);

    } 

    public function store() {
        $this->validate();
        Tax::create([
            "name"        => $this->name,
            "percentage"  => $this->percentage,
            "status"      => $this->status ? 1 : 0,
        ]);

        return redirect(route('tax-management'))->with('status','Tax successfully created.');
    }


    public function render()
    {
        return view('livewire.taxes.create');
    }
}
