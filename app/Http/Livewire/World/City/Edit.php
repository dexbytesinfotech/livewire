<?php

namespace App\Http\Livewire\World\City;

use App\Models\Worlds\Cities;
use App\Models\Worlds\Country;
use App\Models\Worlds\State;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public Cities $city;
    public $country = '';
    public $state = '';
  
    protected function rules(){
        return [
            'city.name' => 'required|max:50|unique:App\Models\Worlds\Cities,name,'.$this->city->id,
            'city.country_id' =>'required',
            'city.state_id' =>'required',
            'city.is_default'=> 'nullable|between:0,1',
            'city.status' => 'nullable|between:0,1'
        ];
    }

    public function mount($id) {

        $this->city = Cities::find($id);
        $this->country = Country::all();
        $this->state = State::where('country_id', $this->city->country_id)->get();

       }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

   
    public function updatedCityCountryId($countryId)
    {
        if (!is_null($countryId)) {
            $this->state = State::where('country_id', $countryId)->get();
        }
    }


    public function edit(){

        $this->validate();

        if($this->city->is_default){
            Cities::where('is_default', 1)->where('country_id', $this->city->country_id )->where('state_id', $this->city->state_id )->update(['is_default' => 0]);
        }

        $this->city->update();

        return redirect(route('city-management'))->with('status', 'City successfully updated.');
    }


    public function render()
    {
        return view('livewire.world.city.edit');
    }
}
