<?php

namespace App\Http\Livewire\Account\Store;

use App\Models\Stores\Store;
use App\Models\Stores\StoreAddress;
use App\Models\Stores\StoreMetaData;
use App\Models\Stores\StoreOwners;
use App\Models\User;
use App\Models\Utils;
use App\Models\Worlds\Cities;
use App\Models\Worlds\Country;
use App\Models\Worlds\State;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Traits\GlobalTrait;
use Illuminate\Support\Arr;

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

    
    protected $listeners = [
        'set:latitude-longitude' => 'setLatitudeLongitude',
        'remove',
        'updatedCountry',
        'updatedState',
        'ownerRemove',
       
    ];

    protected function rules() {
        return [
            'store.email'                  => 'required|email|unique:App\Models\Stores\Store,email,'.$this->store->id,
            'store.name'                   =>  'required|unique:App\Models\Stores\StoreTranslation,name,'.$this->store->id,
            'store.descriptions'           => 'required|max:1000',
            'store.phone'                  => 'required|numeric|digits_between:8,10',        
            'store.country_code'           => 'required',
            'store.number_of_branch'       => 'required|integer',
            'store.order_preparing_time'   => 'required|integer',
            'storeAddress.address_line_1'  => 'required|string',
            'storeAddress.landmark'        => 'required|string',
            'storeAddress.city'         => 'required|string',
            'storeAddress.state'        => 'required|string',
            'storeAddress.country'         => 'required|string',
            'storeAddress.zip_post_code'   => 'required|integer',
            'storeAddress.latitude'        => 'required|between:-90,90',
            'storeAddress.longitude'       => 'required|between:-90,90',       
        ];
    }

    public function setLatitudeLongitude($latitude, $longitude) 
    {    
            $this->latitude = $latitude;
            $this->longitude = $longitude;
    }    
 
    public function mount() {
        $storeId = $this->getStoreId();
        $this->store = Store::with('storeAddress')->find($storeId);  
        $this->store->phone = substr($this->store->phone , +(strlen($this->store->country_code)));
        $this->storeAddress = $this->store->storeAddress;
       
        
        $this->countries = Country::all()->toArray();
 
        $country =   Arr::first($this->countries,function ($val,$key){
            return $val['name'] == $this->storeAddress->country;
        });             
        $country_id = isset($country['id']) ? $country['id'] : 0; 
        if(!empty($country)){
            $this->storeAddress->country = $country_id.','.$this->storeAddress->country;
            $this->states = State::where('country_id', $country_id)->get()->toArray();
        }else{
            $this->states = collect();
        }


        if (empty($this->states)) {
            $this->cities = collect();
        }else{
            $state =   Arr::first($this->states,function ($val,$key){
                return $val['name'] == $this->storeAddress->state;
            });
            $state_id = isset($state['id']) ? $state['id'] : 0; 
            $this->storeAddress->state = $state_id.','.$this->storeAddress->state;
            $this->cities = Cities::where('state_id', $state_id)->get()->toArray();
        }

        $this->accounts = collect();
        $this->bussinessHours =  $this->store->getBusinessHours();
        $this->timeOptionsList = Utils::timeOptions();
        $this->accounts = StoreOwners::where('store_id', $this->store->id)->get();
    }



    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }


    public function updatedBussinessHours()
    {
        $validatedData = $this->validate([
            'bussinessHours.*.opening_time' => 'required_with:bussinessHours.*.closing_time',
            'bussinessHours.*.closing_time' => 'required_with:bussinessHours.*.opening_time|gt:bussinessHours.*.opening_time'
        ],
        [
           'bussinessHours.*.closing_time.gt' => __('account.Closing time must be greater then opening time')
        ]);
       
        $storeHours = Store::find($this->store->id);
        $storeHours->metadata->updateOrCreate(['store_id' => $this->store->id, 'key' => 'business_hours'], ['value'=> $this->bussinessHours]);

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('account.Bussiness hours changed successfully!')]);
    }

    public function update() {

        $validated = $this->validate(); 
        $this->store->phone =  $this->store->country_code. $this->store->phone;
        $this->storeAddress->state   = substr($this->storeAddress->state, strpos($this->storeAddress->state, ",") + 1);   
        $this->storeAddress->country = substr($this->storeAddress->country, strpos($this->storeAddress->country, ",") + 1); 
      
        
        $this->store->update();

        $this->storeAddress->update();

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('account.Store successfully updated')]); 
        
        return redirect(request()->header('Referer'));
    }

    public function updatedCountry()
    {    
        
        if (!is_null($this->storeAddress->country)) {
            $countryId = substr($this->storeAddress->country, 0, strpos($this->storeAddress->country, ','));
            $this->states = State::where('country_id', $countryId)->get();
            if(empty($this->states)){
                $this->states = collect();
            }
            $this->storeAddress->state = '';
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
    
 
    public function render()
    {  
        return view('livewire.account.store');
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
        ['type' => 'success',  'message' => __('account.Status changed successfully!')]);

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
        ['type' => 'success',  'message' => __('account.Logo changed successfully!')]); 

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
                'confirmButtonText' => __('account.Yes, delete it!'),
                'cancelButtonText' => __('account.No ,cancel!'),
                'message' => __('account.Are you sure?'), 
                'text' => __('account.If deleted you will not be able to recover this store!')
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
        ['type' => 'success',  'message' => 'Status changed successfully!']);     

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
                'confirmButtonText' => __('account.Yes, delete it!'),
                'cancelButtonText' => __('account.No ,cancel!'),
                'message' => __('account.Are you sure?'), 
                'text' => 'If deleted You will be able to adding this owner with other store and same store!'
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
        
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => __('account.Remove provider delete successfully!')]);

    } 


}
