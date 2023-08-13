<?php

namespace App\Http\Livewire\Agencies;

use Livewire\Component;
use App\Models\Agencies\Agency;
use App\Models\Worlds\Cities;
use App\Models\Worlds\Country;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{
    use AuthorizesRequests;
    public $agency_name='';
    public $city='';
    public $address= '';
    public $phone_number = '';
    public $country_code = '';
    
    public $cities='';
    public $countries = '';

    /**
     * render the create agencies form
     *
     */
    public function render()
    {
        return view('livewire.agencies.create');
    }

    /**
     * List of add/edit form rules
     * 
     */
    protected $rules=[
        'agency_name' => 'required|string|max:100|min:3|regex:/^[a-zA-Z0-9 ]+$/|unique:App\Models\Agencies\Agency,agency_name',   
        'phone_number' => 'required|numeric|digits:10|regex:/^\+?[1-9][0-9]{7,14}$/',  
        'city' => 'required|max:50|min:3',
        'address' => 'required|max:100|min:3',
        'country_code' => 'required',
        ];

    /**
    * Validate the updated property.
    *
    */
    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    /**
    * Set initial data for the component.
    *
    */
    public function mount(){
        $this->cities = Cities::all();
        $this->countries = Country::all();
        $this->country_code = Country::where('is_default', 1)->value('country_code');
    }

    /**
      * store the agency data in the agencies table
      * @return void
      */
    public function store()
    {
        $this->validate();

        $agency = Agency::create([
            'agency_name'   => $this->agency_name,
            'phone_number'  => $this->phone_number,
            'city'          => $this->city,
            'address'       => $this->address,
            'country_code'  => $this->country_code, 
            'account_status' => "approved",
        ]);

        return redirect(route('agency-management'))->with('status',__('components/agency.Agency Created Successfully'));
    }

}


