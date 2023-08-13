<?php

namespace App\Http\Livewire\Stores;

use App\Models\Stores\BusinessHour;
use Livewire\Component;
use App\Models\Stores\Store;
use App\Models\Worlds\State;
use App\Models\Worlds\Cities;
use Livewire\WithFileUploads;
use App\Models\Worlds\Country;
use App\Models\Stores\StoreType;
use App\Models\Stores\StoreAddress;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{

    use WithFileUploads;
    use AuthorizesRequests;
   
    public $logo_path;
    public $email = '';
    public $name = '';
    public $descriptions='';
    public $phone = '';
    public $number_of_branch = 1;
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
    public $store_types = '';
    public $store_type = '';
    public $userName = '';
    public $country_code = '';

    public $countries;
    public $states;
    public $cities;

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
        'name'                  =>  'required|unique:App\Models\Stores\StoreTranslation,name',
        'store_type'       => 'required',
        'logo_path'             => 'required',
        'descriptions'          => 'required|max:1000',
        'phone'                 => 'required|numeric|digits_between:8,10',
        'status'                => 'nullable|between:0,1',
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
        $this->store_types = StoreType::all();
        $this->country_code = Country::where('is_default', 1)->value('country_code');
    }

    public function updated($propertyName) {
       $this->validateOnly($propertyName);
    } 

    public function store() {

        $descriptions =$this->descriptions;

        if ($descriptions == '<p><br></p>') {
            $this->descriptions = trim(str_replace('<p><br></p>', '',$this->descriptions));        
        }

        $this->validate();

        $storeImage = Image::make($this->logo_path->getRealPath());
        $logoFileName  = time() . '.' . $this->logo_path->getClientOriginalExtension();
        Storage::disk(config('app_settings.filesystem_disk.value'))->put('stores'.'/'.$logoFileName, (string) $storeImage->encode());
        
        $storeImage->resize(420, null, function ($constraint) {
            $constraint->aspectRatio(); 
            $constraint->upsize();                
        });
        Storage::disk(config('app_settings.filesystem_disk.value'))->put('thumbnails'.'/'.$logoFileName, $storeImage->stream());
        $storeLogoPath = 'thumbnails'.'/'.$logoFileName;

        $store = Store::create([
            'name' => $this->name,
            'store_type' => $this->store_type,
            'descriptions' => $this->descriptions,
            'status'=> $this->status ? 1:0,
            'country_code' => $this->country_code,
            'phone' => $this->country_code.$this->phone,
            'email' => $this->email,
            'logo_path' => $storeLogoPath,
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

        $storeModel = new Store;

        $defaultBusinessHours =  collect(json_decode($storeModel->getDefaultBusinessHours(),true))->map(function ($value,$key) use($store)
        {
            $value['store_id'] = $store->id;
            $value['created_at'] = \Carbon\Carbon::now();
            return $value;
        })->all();

        BusinessHour::insert($defaultBusinessHours);

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

    public function updatedLogoPath() {
        $validator = Validator::make(
            ['logo_path' => $this->logo_path],
            ['logo_path' => 'mimes:jpg,jpeg,png|required|max:1024'],
        );

        if ($validator->fails()) {
            $this->reset('logo_path');
            $this->setErrorBag($validator->getMessageBag());
            return redirect()->back();
        }
    }
    
    public function render()
    {
       return view('livewire.store.create');
    }

}
