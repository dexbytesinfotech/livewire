<?php

namespace App\Http\Livewire\World\City;

use App\Models\Worlds\Cities;
use App\Models\Worlds\Country;
use App\Models\Worlds\State;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
 
    public $name = '';
    public $country_id = '';
    public $state_id = '';
    public $is_default = '';
    public $is_active = '';
    public $country = '';
    public $state = '';


    protected $rules = [
        'name' => 'required|max:50|unique:App\Models\Worlds\Cities,name',
        'country_id' =>'required',
        'state_id' =>'required',
        'is_default'=> 'nullable|between:0,1',
        'is_active' => 'nullable|between:0,1'
    ];


    protected $messages = [
        'country_id.required' => 'The Country name is required.',
        'state_id.required' => 'The State name is required.',
       
    ];


    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 


    public function mount(){
        $this->country = Country::all();
        $this->state = collect();
    }


    public function store(){

        $this->validate();

        if($this->is_default){
            Cities::where('is_default', 1)->where('country_id', $this->country_id )->where('state_id', $this->state_id )->update(['is_default' => 0]);
        }

        Cities::create([
            'name'         => $this->name,
            'country_id'  => $this->country_id,
            'state_id'  => $this->state_id,
            'is_default'   => $this->is_default ? 1 : 0,
            'status' => $this->is_active ? 1 : 0,
        ]);
        
        return redirect(route('city-management'))->with('status','City successfully created.');
    }


    public function updatedCountryId($countryId)
    {
        if (!is_null($countryId)) {
            $this->state = State::where('country_id', $countryId)->get();
        }
    }


    public function render()
    {
        return view('livewire.world.city.create');
    }
}
