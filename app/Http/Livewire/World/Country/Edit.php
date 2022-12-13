<?php

namespace App\Http\Livewire\World\Country;

use App\Models\Worlds\Country;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public Country $country;

    protected function rules(){
        return [
            'country.name' => 'required|max:50|unique:App\Models\Worlds\Country,name,'.$this->country->id,
            'country.country_ios_code' => 'nullable|Max:2|Min:1|required|unique:App\Models\Worlds\Country,country_ios_code,' .$this->country->id,
            'country.nationality' => 'nullable|string',
            'country.is_default'=> 'nullable|between:0,1',
            'country.status' => 'nullable|between:0,1',
            'country.country_code' => 'required|numeric|unique:App\Models\Worlds\Country,country_code,'.$this->country->id,
        ];
    }

    public function mount($id) {

        $this->country = Country::find($id);
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit(){
    
        $this->validate();
        if($this->country->is_default){
            Country::where('is_default', 1)->update(['is_default' => 0]);
        } 

         
        if(Country::where('is_default', 1)->doesntExist()) {
            $this->country->is_default = 1;
        }
        
        $this->country->update();

        return redirect(route('country-management'))->with('status', 'Country successfully updated.');
    }



    public function render()
    {
        return view('livewire.world.country.edit');
    }
}
