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
        'ownerRemove'
    ];

    protected function rules() {
        return [
            'store.email'                  => 'required|email|unique:App\Models\Stores\Store,email,'.$this->store->id,
            'store.name'                   =>  'required|unique:App\Models\Stores\Store,name,'.$this->store->id,
            'store.descriptions'           => 'required|max:1000',
            'store.phone'                  => 'required|numeric|digits_between:8,10',        
            'store.country_code'           => 'required',
            'store.number_of_branch'       => 'required|integer',
            'store.order_preparing_time'   => 'required|integer',
            'storeAddress.address_line_1'  => 'required|string',
            'storeAddress.landmark'        => 'required|string',
            // 'storeAddress.city'         => 'required|string',
            // 'storeAddress.state'        => 'required|string',
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

        $this->countries = Country::all();
        $this->states = State::where('name', $this->storeAddress->country)->get();
        $this->cities = Cities::where('name', $this->storeAddress->state)->get();
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
           'bussinessHours.*.closing_time.gt' => 'Closing time must be greater then opening time!'
        ]);
       
        $storeHours = Store::find($this->store->id);
        $storeHours->metadata->updateOrCreate(['store_id' => $this->store->id, 'key' => 'business_hours'], ['value'=> $this->bussinessHours]);

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Bussiness Hours changed Successfully!']);
    }

    public function update() {

        $validated = $this->validate(); 
        $this->store->phone =  $this->store->country_code. $this->store->phone;
        $this->store->update();

        $this->storeAddress->update();

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Store successfully updated!']); 
        
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


}
