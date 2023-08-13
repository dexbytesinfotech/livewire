<?php

namespace App\Http\Livewire\World\State;

use App\Models\Worlds\Country;
use App\Models\Worlds\State;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
 
    public $name = '';
    public $country_id = '';
    public $abbreviation = '';
    public $is_default = '';
    public $status = '';
    public $country = '';

    protected $rules = [
        'name' => 'required|max:50|unique:App\Models\Worlds\State,name',
        'country_id' =>'required',
        'is_default'=> 'nullable|between:0,1',
        'status' => 'nullable|between:0,1'
    ];
    public function messages()
    {
        return[
        'country_id.required' => __('world.The Country name is required.'),
        
    ];

    }


    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 
    public function mount(){
        $this->country = Country::all();
         
    }
    public function store(){

        $this->validate();

        if($this->is_default){
            State::where('is_default', 1)->where('country_id', $this->country_id )->update(['is_default' => 0]);
        }

        State::create([
            'name'         => $this->name,
            'country_id'  => $this->country_id,
            'is_default'   => $this->is_default?1:0,
            'status' => $this->status?1:0,
        ]);
        
        return redirect(route('state-management'))->with('status',__('world.State successfully created.'));
    }



    public function render()
    {
        return view('livewire.world.state.create');
    }
}
