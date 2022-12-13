<?php

namespace App\Http\Livewire\UserManagement;

use App\Constants\OrderReviewTypes;
use App\Models\Address;
use App\Models\Driver\UserDriver;
use App\Models\Stores\StoreOwners;
use App\Models\User;
use App\Models\Users\UserMetaData;
use App\Models\Worlds\Country;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class View extends Component
{


    use WithFileUploads;
    use AuthorizesRequests;

    public User $user;
    public $address;
    public $profile_photo;
    public $roles;
    public $role_id = []; 
    public $countries = '';
    public $userId = '';
    public $confirmationPassword ='';
    public $new_password = "";
    public $stores;
    public $userMeta;
    public $orderReviewType = [];  
    public $driver_commission_value;
    public $is_global_commission;
    

 
    protected $listeners = [
        'remove',
        'ownerRemove',
        'getRoleIdForInput'
    ];

    
    protected function rules(){
        return [
            'user.email' => 'required|email|unique:App\Models\User,email,'.$this->user->id,
            'user.name' =>'required',
            'user.phone' =>'required|min:8|unique:App\Models\User,phone,'.$this->user->id,            
            'role_id' => 'required',
            'user.country_code' => 'required',
        ];
    }

    public function mount($id) {

        $this->user = User::find($id);
      
        $this->user->phone = substr($this->user->phone , +(strlen($this->user->country_code)));
        $this->roles = Role::where('guard_name', 'web')->where('status', 1)->get(['id','name']);
        $this->role_id  = $this->user->getRoleNames();
        $this->countries = Country::all();
        $this->address = Address::where('user_id' , $this->user->id)->get();
        $this->stores = StoreOwners::where('user_id', $this->user->id)->get();
        $this->userMeta = UserMetaData::where('user_id' , $this->user->id)->get();
 
        $orderReviewType = new OrderReviewTypes;
        $this->orderReviewType = $orderReviewType->getConstants();
       
        $this->driver_commission_value =  !empty($this->user->driver) ? $this->user->driver->driver_commission_value : 0;
        $this->is_global_commission =  !empty($this->user->driver) ? $this->user->driver->is_global_commission : 0;
 
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    public function resetField(){
        $this->user->phone = substr($this->user->phone , (strlen($this->user->country_code)));
    }
    
    public function update(){
        
        $this->validate();
        $this->user->phone =  $this->user->country_code. $this->user->phone;
        if(!empty($this->role_id)){
            $this->user->syncRoles($this->role_id);     
        }
        if(!$this->user->hasRole('Driver')){
        UserDriver::whereUserId($this->user->id)->delete();    
        } 
      
         if($this->user->hasRole('Driver')){
             UserDriver::updateOrCreate([
                 'user_id' =>$this->user->id
                ], ['user_id' => $this->user->id,
                     'is_live' => 0 ]
            ); 
          }
            
      
        $this->user->save();
        $this->resetField();
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'User successfully updated.']); 
    }


    public function updatedIsGlobalCommission(){
       
        $this->is_global_commission = $this->is_global_commission ? 1 : 0;
        $this->user->driver->update(['is_global_commission' => $this->is_global_commission, 'driver_commission_value' => config('app_settings.driver_commission.value')]);
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Commission successfully updated.']);
    }


    public function updatedDriverCommissionValue(){
       
        $this->validate([
            'driver_commission_value' => 'required|max:'.config('app_settings.driver_commission.value').'|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);
        
        $this->user->driver->update(['driver_commission_value' => $this->driver_commission_value]);
     
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Commission successfully updated.']);
    }

     /**
     * update user Profile
     *
     * @return response()
     */
    public function updatedProfilePhoto()
    {        
        $this->validate([
            'profile_photo' => 'required|mimes:jpg,jpeg,png|max:1024',
        ]);
          
        $profile_photo = $this->profile_photo->store('users', config('app_settings.filesystem_disk.value'));
        User::where('id', '=' , $this->user->id )->update(['profile_photo' => $profile_photo]);
        
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Profile photo changed Successfully!']); 

   }


   
    public function passwordUpdate(){

        $this->validate([ 
            'new_password' => 'required|min:7',
            'confirmationPassword' => 'required|min:7|same:new_password'
        ]);  
                 
        $user = User::findorFail($this->user->id);
        $user->password = $this->new_password;
        $user->save();

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Password successfully updated.']); 
    
    } 


     /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($userId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        User::where('id', '=' , $userId )->update(['status' => $status]);     

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
                'text' => 'If deleted, You will be not able to adding this store with owner!'
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
        $this->accounts = StoreOwners::where('user_id', $this->user->id)->get();
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Remove Store Delete Successfully!', 
                'text' => 'It will not list on store table soon.'
            ]);
            return redirect(request()->header('Referer'));     
    } 


    
     /**
     * update application status
     *
     * @return response()
     */
    public function suspendedConfirm($user)
    {  
        $account_status = ( $user['driver']['account_status'] == 'suspended' ) ? 'approved' : 'suspended';
        $status = ($user['driver']['account_status'] == 'suspended'  ) ? 0 : 1;
        $this->user->driver->update(['account_status' => $account_status, 'is_live' => 0]);      
        $this->user->account_status = $account_status ;
   }

    public function render()
    {
        return view('livewire.user-management.view');
    }

    
    public function hydrate()
    {
        $this->emit('select2');
    }

    public function getRoleIdForInput($value){ 
        $this->role_id = $value;
    }
}
