<?php

namespace App\Http\Livewire\Stores;

use App\Models\Stores\Store;
use App\Models\Stores\StoreAddress;
use App\Models\Stores\StoreMetaData;
use App\Models\Stores\StoreOwners;
use App\Models\Stores\StoreType;
use App\Models\User;
use App\Models\Utils;
use App\Models\Worlds\Cities;
use App\Models\Worlds\Country;
use App\Models\Worlds\State;
use App\Traits\GlobalTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use DB;

class Edit extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    use GlobalTrait;
    
    public $latitude = '';
    public $longitude = '';
    public $logo_path = '';
    public $countries;
    public $states;
    public $cities;
    public StoreAddress $storeAddress;
    public Store $store;
    public $accounts;
    public $bussinessHours;
    public $timeOptionsList;
    public $store_type;
    public $search ;
    public $searchResultProviders; 
    public $store_id = '';
    public $user_id = '';
 
    public $commission_value;
    public $is_global_commission;
 

    protected $listeners = [
        'set:latitude-longitude' => 'setLatitudeLongitude',
        'remove',
        'providerSubmit',
        'ownerRemove', 
        'updatedCountry',
        'updatedState',
        'refreshComponent' => '$refresh'
    ];

    protected function rules() {
        return [
            'store.email'                 => 'required|email|unique:App\Models\Stores\Store,email,'.$this->store->id,
            'store.name'                  =>  'required|unique:App\Models\Stores\Store,name,'.$this->store->id,
            'store.restaurant_type'       => 'required',
            'store.descriptions'          => 'required|max:1000',
            'store.phone'                 => 'required|numeric|digits_between:8,10',        
            'store.country_code'           => 'required',
            'store.number_of_branch'       => 'required|integer',
            'store.order_preparing_time'  => 'required|integer',
            'storeAddress.address_line_1'        => 'required|string',
            'storeAddress.landmark'              => 'required|string',
            'storeAddress.city'                  => 'required|string',
            'storeAddress.state'                 => 'required|string',
            'storeAddress.country'               => 'required|string',
            'storeAddress.zip_post_code'         => 'required|integer',
            'storeAddress.latitude'              => 'required|between:-90,90',
            'storeAddress.longitude'             => 'required|between:-90,90',     
          
            
        ];
    }

    public function setLatitudeLongitude($latitude, $longitude, $name) 
    {    
    
            $this->storeAddress->latitude = $latitude;
            $this->storeAddress->longitude = $longitude;
            $this->storeAddress->landmark = $name;
    }    
 
 
    public function mount($id) {
       
       
        $this->store = Store::with('storeAddress')->withAvg('OrderRating','rating')->withCount('OrderRating')->find($id);
        $this->store->phone = substr($this->store->phone , +(strlen($this->store->country_code)));
        $this->storeAddress = $this->store->storeAddress;
        $this->searchResultProviders = collect();
        $this->countries = Country::all()->toArray();
        $countryKey = array_search($this->storeAddress->country, array_column($this->countries, 'name'));        
        if(array_key_exists($countryKey, $this->countries)){
            $this->storeAddress->country = $this->countries[$countryKey]['id'].','.$this->storeAddress->country;
            $this->states = State::where('country_id', $this->countries[$countryKey]['id'])->get()->toArray();
        }else{
            $this->states = collect();
        }

        $stateKey = array_search($this->storeAddress->state, array_column($this->states, 'name'));
        if(array_key_exists($stateKey, $this->states)){ 
            $this->storeAddress->state = $this->states[$stateKey]['id'].','.$this->storeAddress->state;
            $this->cities = Cities::where('state_id', $this->states[$stateKey]['id'])->get()->toArray();
        }else{
            $this->cities = collect();
        }

        $this->accounts = collect();
        $this->bussinessHours =  $this->store->getBusinessHours();
        $this->timeOptionsList = Utils::timeOptions();
        $this->accounts = StoreOwners::where('store_id', $this->store->id)->get();
        $this->store_type = StoreType::all();

        $this->commission_value = $this->store->commission_value;
        $this->is_global_commission = $this->store->is_global_commission;
  
    }

    public function providerSubmit($id){
       $this->validate([ 
           'store_id'   => 'nullable',
           'user_id'    => 'nullable', 
        ]);
          StoreOwners::create([
            'store_id'=> $this->store->id,
             'user_id' => $id ,
        ]);
        
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Provider add Successfully!']);
        $this->resetField();  

        return redirect(request()->header('Referer'));
       
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function updatedIsGlobalCommission(){
       
        $this->is_global_commission = $this->is_global_commission ? 1 : 0;
        $this->store->update(['is_global_commission' => $this->is_global_commission, 'commission_value' => config('app_settings.store_commission.value')]);
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Commission successfully updated.']);
    }


    
    public function updatedCommissionValue(){
       
        $this->validate([
            'commission_value' => 'required|numeric|between:0,100',
        ]);
        
        $this->store->update(['commission_value' => $this->commission_value]);
     
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Commission successfully updated.']);
    }

    public function updatedBussinessHours()
    {
        $validatedData = $this->validate([
            'bussinessHours.*.opening_time' => 'required_with:bussinessHours.*.closing_time',
            'bussinessHours.*.closing_time' => 'required_with:bussinessHours.*.opening_time|gt:bussinessHours.*.opening_time'
        ],
        [
           'bussinessHours.*.closing_time.gt' => 'Closing time must be greater then opening time!'
        ]);
       
        $storeHours = Store::find($this->store->id);
        $storeHours->metadata->updateOrCreate(['store_id' => $this->store->id, 'key' => 'business_hours'], ['value'=> $this->bussinessHours]);

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Bussiness Hours changed Successfully!']);
    }

    public function resetField (){
        $this->store->phone = substr($this->store->phone , (strlen($this->store->country_code)));     
        $this->search = '';      
        $this->emit('refreshComponent');      
    }

    public function update() {

        $validated = $this->validate(); 
        $this->store->phone =  $this->store->country_code. $this->store->phone;
        $this->storeAddress->state   = substr($this->storeAddress->state, strpos($this->storeAddress->state, ",") + 1);   
        $this->storeAddress->country = substr($this->storeAddress->country, strpos($this->storeAddress->country, ",") + 1); 
 
        $this->store->update();
        $this->storeAddress->update();

        $this->resetField();
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Store successfully updated!']); 
        
    }
 
    public function render()
    {   
       return view('livewire.store.edit' );
            
    }

    /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($storeId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        Store::where('id', '=' , $storeId )->update(['status' => $status]);      

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Status changed Successfully!']);

   }


   /**
     * update store status
     *
     * @return response()
     */
    public function updatedLogoPath()
    {        
        $this->validate([
            'logo_path' => 'required|mimes:jpg,jpeg,png|max:1024',
        ]);
          
        $logo_path = $this->logo_path->store('stores', config('app_settings.filesystem_disk.value'));
        Store::where('id', '=' , $this->store->id )->update(['logo_path' => $logo_path]);
        
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Logo changed Successfully!']); 

   }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($storeId)
    {
        $this->deleteId  = $storeId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this store data!'
            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        Store::find($this->deleteId)->delete();

        return redirect(route('store-management'))->with('status','Store successfully deleted.');
    }  
    
            
    /**
     * update user status
     *
     * @return response()
     */
    public function statusAccountUpdate($userId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        User::where('id', '=' , $userId )->update(['status' => $status]);

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Status changed Successfully!']);     

   }


       /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyOwnerConfirm($storeOnwerId)
    {
        $this->deleteId  = $storeOnwerId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'ownerRemove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, You will be able to adding this owner with other store and same store!'
            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ownerRemove()
    {
        StoreOwners::find($this->deleteId)->delete();
        $this->accounts = StoreOwners::where('store_id', $this->store->id)->get();
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Remove provider Delete Successfully!', 
                'text' => 'It will not list on store provider table soon.'
            ]);
    } 

    public function updatedCountry()
    {    
        if (!is_null($this->storeAddress->country)) {
            $countryId = substr($this->storeAddress->country, 0, strpos($this->storeAddress->country, ','));
            $this->states = State::where('country_id', $countryId)->get();
            $this->cities = collect();
        }
    }

    public function updatedState()
    {   
        if (!is_null($this->storeAddress->state)) {
            $stateId = substr($this->storeAddress->state, 0, strpos($this->storeAddress->state, ','));
            $this->cities = Cities::where('state_id', $stateId)->get();
           
        }
    }
    
    /**
     * update application status
     *
     * @return response()
     */
    public function suspendedConfirm($store)
    {  
        $application_status = ( $store['application_status'] == 'suspended' ) ? 'approved' : 'suspended';
        $status = ( $store['application_status'] == 'suspended'  ) ? 0 : 1;
        Store::where('id', '=' , $store['id']  )->update(['application_status' => $application_status, 'status' => $status]);      
        $this->store->application_status = $application_status ;
   }



   public function updatedSearch()
   {  
       if($this->search) {
            $this->searchResultProviders =  User::doesntHave('store')->whereHas('roles', function ($query) {
                $query->where('name' , '=' ,  'Provider');
            })->where(function($query){
                $query->where(DB::raw('lower(name)'), 'like', '%'.$this->search.'%')
                ->orWhere('phone', 'like', '%'.$this->search.'%');
            })->get();
     
       } else {
            $this->searchResultProviders = collect();
       }
   }

    }

