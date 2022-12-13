<?php

namespace App\Http\Livewire\Stores;

use App\Models\Stores\Store;
use App\Models\Stores\StoreAddress;
use App\Models\Stores\StoreMetaData;
use App\Models\Stores\StoreOwners;
use App\Models\Stores\StoreType;
use App\Models\User;
use App\Models\Worlds\Cities;
use App\Models\Worlds\Country;
use App\Models\Worlds\State;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;
    use AuthorizesRequests;
   
    public $logo_path;
    public $email = '';
    public $name = '';
    public $descriptions = '';
    public $phone = '';
    public $order_preparing_time = '';
    public $number_of_branch = '';
    public $status = ''; 
    public $address_line_1 = '';
    public $landmark = '';
    public $city = '';
    public $state = '';
    public $country = '' ;
    public $zip_post_code = '';
    public $latitude = '';
    public $longitude = '';
    public $store_address = '';
    public $restaurant_type = '';
    public $userName = '';
    public $country_code = '';

    public $countries;
    public $states;
    public $cities;
    public $store_type ;

    protected $listeners = [
        'set:latitude-longitude' => 'setLatitudeLongitude'
    ];

    public function setLatitudeLongitude($latitude, $longitude, $name) 
   {    
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->landmark = $name;
   }    

    protected $rules = [
        'email'                 => 'required|email|unique:App\Models\Stores\Store,email',
        'name'                  =>  'required|unique:App\Models\Stores\Store,name',
        'restaurant_type'       => 'required',
        'logo_path'             => 'required|mimes:jpg,jpeg,png|max:1024',
        'descriptions'          => 'required|max:1000',
        'phone'                 => 'required|numeric|digits_between:8,10',
        'order_preparing_time'  => 'required|integer',
        'number_of_branch'      => 'required|integer',
        'status'                => 'nullable|integer',
        'address_line_1'        => 'required|string',
        'landmark'              => 'required|string',
        'city'                  => 'required|string',
        'state'                 => 'required|string',
        'country'               => 'required|string',
        'country_code'           => 'required',
        'zip_post_code'         => 'required|integer',
        'latitude'              => 'required|between:-90,90',
        'longitude'             => 'required|between:-90,90',
        
    ];

    public function mount() {
        $this->countries = Country::all();
        $this->states = collect();
        $this->cities = collect();
        $this->store_type = StoreType::all();
        $this->country_code = Country::where('is_default', 1)->value('country_code');
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    } 

    public function store(){
        $this->validate(); 
        $store = Store::create([
            'name' => $this->name,
            'restaurant_type' => $this->restaurant_type,
            'descriptions' => $this->descriptions,
            'status'=> $this->status ? 1:0,
            'country_code' => $this->country_code,
            'phone' => $this->country_code.$this->phone,
            'email' => $this->email,
            'order_preparing_time' => $this->order_preparing_time,
            'logo_path' =>  $this->logo_path->store('stores', config('app_settings.filesystem_disk.value')),
            'number_of_branch' => $this->number_of_branch,
            'application_status' => 'approved'
        ]);
   
        StoreAddress::create([           
            'store_id' => $store->id,
            'address_line_1' => $this-> address_line_1,
            'landmark'  => $this->landmark,
            'city'    => $this->city,
            'state'   => substr($this->state, strpos($this->state, ",") + 1),    
            'country' => substr($this->country, strpos($this->country, ",") + 1),   
            'zip_post_code' => $this->zip_post_code,
            'latitude'      => $this->latitude ? $this->latitude : null ,     
            'longitude' => $this->longitude ? $this->longitude : null ,
            'address_type' => 'name'   
        ]);

        $storeModel = new Store();
        StoreMetaData::create([
            'store_id'  => $store->id,
            'key'       => 'business_hours',
            'value'     => $storeModel->getDefaultBusinessHours()
        ]);
    
        return redirect(route('store-management'))->with('status','Store successfully created.');
    }

    public function updatedCountry($countryId)
    {     
        if (!is_null($countryId)) {
            $countryId = substr($countryId, 0, strpos($countryId, ','));
            $this->states = State::where('country_id', $countryId)->get();
        }
    }

    public function updatedState($stateId)
    {   
        if (!is_null($stateId)) {
            $stateId = substr($stateId, 0, strpos($stateId, ','));
            $this->cities = Cities::where('state_id', $stateId)->get();
        }
    }
    
    public function render()
    {
       return view('livewire.store.create');
    }

}
