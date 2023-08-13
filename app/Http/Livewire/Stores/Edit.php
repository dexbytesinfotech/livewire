<?php

namespace App\Http\Livewire\Stores;


use App\Models\User;
use App\Models\Utils;
use Livewire\Component;
use App\Traits\GlobalTrait;
use Illuminate\Support\Arr;
use App\Models\Stores\Store;
use App\Models\Worlds\State;
use Livewire\WithPagination;
use App\Models\Worlds\Cities;
use Livewire\WithFileUploads;
use App\Models\Worlds\Country;
use App\Models\Stores\StoreType;
use App\Models\Stores\StoreOwners;
use App\Models\Stores\BusinessHour;
use App\Models\Stores\StoreAddress;
use App\Models\Stores\StoreMetaData;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Events\InstantMailNotification;
use Mail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
    public $bussinessHours=[];
    public $editedBussinessHourIndex = null;
    public $timeOptionsList;
    public $store_type;
    public $search ;
    public $searchResultProviders; 
    public $store_id = '';
    public $user_id = '';
    public $selected_user_id = "";
 
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
        $store = isset($this->store->translate($this->lang)->id)  ? ','.$this->store->translate($this->lang)->id : null;
        return [
            'store.email'                 => 'required|email|unique:App\Models\Stores\Store,email,'.$this->store->id,
            'store.name'                  =>  'required|unique:App\Models\Stores\StoreTranslation,name'.$store,
            'store.store_type'       => 'required',
            'store.descriptions'          => 'required|max:1000',
            'store.phone'                 => 'required|numeric|digits_between:8,10',        
            'store.country_code'           => 'required',
            'store.number_of_branch'       => 'required|integer',
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
      
        //  Store translate
        $this->lang = request()->ref_lang;
        $this->languages = request()->language;
        
       

        //  Store translate       
        $this->store = Store::with('storeAddress')->find($id);
       

        $this->store->name = isset($this->store->translate($this->lang)->name) ?  $this->store->translate($this->lang)->name: $this->store->translate(config('app.locale'))->name;
        $this->store->descriptions = isset($this->store->translate($this->lang)->descriptions) ? $this->store->translate($this->lang)->descriptions : $this->store->translate(config('app.locale'))->descriptions;
        $this->store->content = isset($this->store->translate($this->lang)->content) ?  $this->store->translate($this->lang)->content: $this->store->translate(config('app.locale'))->content;
        $this->store->restorant_type = isset($this->store->translate($this->lang)->restorant_type) ? $this->store->translate($this->lang)->restorant_type : $this->store->translate(config('app.locale'))->restorant_type;

        $this->store->phone = substr($this->store->phone , +(strlen($this->store->country_code)));
        $this->storeAddress = $this->store->storeAddress;
        $this->searchResultProviders = collect();
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
        $this->timeOptionsList = Utils::timeOptions();
        $this->bussinessHours = collect(BusinessHour::where('store_id',$this->store->id)->get())->map(function($value,$key) {
          $value->status = (boolean) $value->status;
          return $value;
        });
        
        $this->timeOptionsList = Utils::timeOptions();
        $this->accounts = StoreOwners::where('store_id', $this->store->id)->get();
        $this->store_type = StoreType::withTranslation()->translatedIn($this->lang)->get();

        $this->commission_value = $this->store->commission_value;
        $this->is_global_commission = $this->store->is_global_commission;
  
    }

    public function providerSubmit(){
       if(!$this->selected_user_id) {
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Please select a provider !']);
            return false;
       }

       $this->validate([ 
           'store_id'   => 'nullable',
           'user_id'    => 'nullable', 
        ]);
          StoreOwners::create([
            'store_id'=> $this->store->id,
             'user_id' =>$this->selected_user_id,
        ]);
        
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('store.Provider add Successfully!')]);
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
        ['type' => 'success',  'message' => __('store.Commission successfully updated.')]);
    }


    
    public function updatedCommissionValue(){
       
        $this->validate([
            'commission_value' => 'required|numeric|between:0,100',
        ]);
        
        $this->store->update(['commission_value' => $this->commission_value]);
     
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('store.Commission successfully updated.')]);
    }

    public function editBussinessHour($index) {
        $this->editedBussinessHourIndex = $index;
        $bussinessHour=$this->bussinessHours[$this->editedBussinessHourIndex] ?? NULL;
        if(!is_null($bussinessHour)) {
            $editedBussinessHour = BusinessHour::find($bussinessHour['id']);
            if($editedBussinessHour) {
                $editedBussinessHour->update($bussinessHour);
                $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'Bussiness Hours Changed Successfully!']);
            }
        }
        $this->editedBussinessHourIndex = null;
    }

    public function changeOpeningTime($index , $opening_time) {
        $this->editedBussinessHourIndex = $index;
        $bussinessHour=$this->bussinessHours[$this->editedBussinessHourIndex] ?? NULL;
        if(!is_null($bussinessHour)) {
            BusinessHour::where('id', '=' , $bussinessHour['id'] )->update(['opening_time' => $opening_time]);
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Bussiness Hours Changed Successfully!']);
        }
        $this->editedBussinessHourIndex = null;
    }

    public function changeClosingTime($index, $closing_time) {
        $this->editedBussinessHourIndex = $index;
        $bussinessHour=$this->bussinessHours[$this->editedBussinessHourIndex] ?? NULL;
       
        if(!is_null($bussinessHour)) {
            if($bussinessHour["closing_time"] < $bussinessHour["opening_time"]) {
                $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'Closing time must be greater then opening time.Please select again!']);
            } else{
                BusinessHour::where('id', '=' , $bussinessHour['id'] )->update(['closing_time' => $closing_time]);
                $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'Bussiness Hours Changed Successfully!']);
            }
        }
        $this->editedBussinessHourIndex = null;
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
        ['type' => 'success',  'message' =>__('store.Store successfully updated!')]); 

        return redirect(request()->header('Referer'));
        
    }

    public function close() {
        $this->resetField();
    }
 
    public function render()
    {   
       if ($this->lang != app()->getLocale()) {
        return view('livewire.store.edit-language');
        }
        return view('livewire.store.edit');
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
        
        $storeDatas =  StoreOwners::where("store_id", $storeId)->with(["user"])->get();
       
        if($storeDatas) {
            foreach($storeDatas as $storeData ) {
                event(new InstantMailNotification($storeData["user_id"], [
                    "code" =>  'forget_password',
                    "args" => [
                          'name' => $storeData["user"]["name"],
                    ]
                ]));
            }
        }

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('store.Status changed Successfully!')]);

   }

   /**
    * Update store open status
    * @return response()
    */
    public function openStatusUpdate($storeId, $status) {
        $status = ( $status == 1 ) ? 0 : 1;
        Store::where('id', '=' , $storeId )->update(['is_open' => $status]);

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('store.Store open status changed successfully!')]);     
    }


   /**
     * update store status
     *
     * @return response()
     */
    public function updatedLogoPath()
    {   
        $validator = Validator::make(
            ['logo_path' => $this->logo_path],
            ['logo_path' => 'mimes:jpg,jpeg,png|required|max:1024'],
        );

        if ($validator->fails()) {
            $this->reset('logo_path');
            $this->setErrorBag($validator->getMessageBag());
            return redirect()->back();
        }

            //Upload original
            $this->logo_path->store('/stores/original', config('app_settings.filesystem_disk.value'));
        
            //Upload thumbnails
            $filePath = '/stores/thumbnails/' . $this->logo_path->hashName();  
            $image = Image::make($this->logo_path)->resize(420, null, function ($constraint) {
                $constraint->aspectRatio();  
                $constraint->upsize();               
            })->stream();
            
            Storage::disk(config('app_settings.filesystem_disk.value'))->put($filePath , $image->__toString());
 
            Store::where('id', '=' , $this->store->id )->update(['logo_path' =>  $filePath]);
        
         $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('store.Logo changed Successfully!')]); 
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
                'confirmButtonText' => __('store.Yes, delete it!'),
                'cancelButtonText' => __('store.No, cancel!'),
                'message' =>__( 'store.Are you sure?'), 
                'text' => __('store.If deleted, you will not be able to recover this store data!')
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

        return redirect(route('store-management'))->with('status',__('store.Store successfully deleted.'));
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
        ['type' => 'success',  'message' => __('store.Status changed Successfully!')]);     

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
                'confirmButtonText' => __('store.Yes, delete it!'),
                'cancelButtonText' => __('store.No, cancel!'),
                'message' => __('store.Are you sure?'), 
                'text' => __('store.If deleted, You will be able to adding this owner with other store and same store!')
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
            ['type' => 'success',  'message' => __('store.Remove provider Delete Successfully!')]);

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
        $storeId = $store["id"];
        $application_status = ( $store['application_status'] == 'suspended' ) ? 'approved' : 'suspended';
        $status = ( $store['application_status'] == 'suspended'  ) ? 0 : 1;
        Store::where('id', '=' , $store['id']  )->update(['application_status' => $application_status, 'status' => $status]);      
        $this->store->application_status = $application_status ;

        $storeDatas =  StoreOwners::where("store_id", $storeId)->with(["user"])->get();
       
        if($storeDatas) {
            foreach($storeDatas as $storeData ) {
                event(new InstantMailNotification($storeData["user_id"], [
                    "code" =>  'forget_password',
                    "args" => [
                          'name' => $storeData["user"]["name"],
                    ]
                ]));
            }
        }
   }



   public function updatedSearch()
   {   
       $this->searchResultProviders = "";
       $this->selected_user_id = "";

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

   public function selectedUser($userId) {

        if($this->selected_user_id  == $userId) {
            $this->selected_user_id = "";
        } else {
            $this->selected_user_id = $userId;
        }
   }

   public function editTranslate()
    {
        $store = isset($this->store->translate($this->lang)->id)  ? ','.$this->store->translate($this->lang)->id : null;
        $request =  $this->validate([
            'store.name'                  =>  'required|unique:App\Models\Stores\StoreTranslation,name'.$store,
            'store.descriptions'       => 'required',
            'store.store_type'       => 'required',
        ]);

        $data = [
            $this->lang => $request['store']
        ];
        $store = Store::findOrFail($this->store->id);
        $store->update($data);

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Store successfully updated.']);
    }


}

