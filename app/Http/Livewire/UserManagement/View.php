<?php

namespace App\Http\Livewire\UserManagement;

use App\Models\User;
use App\Models\Address;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Worlds\Country;
use App\Models\Stores\StoreOwners;
use App\Models\Users\UserMetaData;
use Spatie\Permission\Models\Role;
use App\Constants\OrderReviewTypes;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use App\Events\InstantMailNotification;

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
    public $is_global_commission;
    public $deleteId = '';
    public $accounts = '';
    
    protected $listeners = [
        'remove',
        'ownerRemove',
        'getRoleIdForInput'
    ];

    
    protected function rules(){
        return [
            'user.email' => 'email|unique:App\Models\User,email,'.$this->user->id,
            'user.first_name' =>'required|regex:/^[a-zA-Z ]+$/|min:3',
            'user.last_name' =>'required|regex:/^[a-zA-Z ]+$/|min:3',
            'user.phone' =>'required|numeric|digits_between:8,10|phone',            
            'role_id' => 'required',
            'user.country_code' => 'required',
        ];
    }

    public function mount($id) {

        $this->user = User::find($id);
        $this->roles = Role::where('guard_name', 'web')->where('status', 1)->get(['id','name']);
        $this->role_id  = $this->user->getRoleNames();
        // dd($this->role_id);
        $this->countries = Country::all();
        $this->address = Address::where('user_id' , $this->user->id)->get();
        $this->stores = StoreOwners::where('user_id', $this->user->id)->get();
        $this->userMeta = UserMetaData::where('user_id' , $this->user->id)->get();
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    
    public function update(){
        
        $this->validate();
        if(!empty($this->role_id)){
            $this->user->syncRoles($this->role_id);     
        }      
        $this->user->save();
        return redirect(route('user-management'))->with('status',__('user.User successfully updated.'));
    }

     /**
     * update user Profile
     *
     * @return response()
     */
    public function updatedProfilePhoto()
    {        

        $validator = Validator::make(
            ['profile_photo' => $this->profile_photo],
            ['profile_photo' => 'mimes:jpg,jpeg,png|required|max:1024'],
        );
     
        if ($validator->fails()) {
            $this->reset('profile_photo');
            $this->setErrorBag($validator->getMessageBag());
            return redirect()->back();
        }

        $img = Image::make($this->profile_photo->getRealPath());
        $fileName  = time() . '.' . $this->profile_photo->getClientOriginalExtension();
        Storage::disk(config('app_settings.filesystem_disk.value'))->put('users/original/'.$fileName, (string) $img->encode());
        
        $img->resize(170, null, function ($constraint) {
            $constraint->aspectRatio();   
            $constraint->upsize();              
        });
        Storage::disk(config('app_settings.filesystem_disk.value'))->put('users/thumbnails'.'/'.$fileName, $img->stream());
        $uploaded_path = 'users/thumbnails'.'/'.$fileName;
        User::where('id', '=' , $this->user->id )->update(['profile_photo' => $uploaded_path]);
        
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('user.Profile photo changed Successfully!')]); 

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
        ['type' => 'success',  'message' => __('user.Password successfully updated.')]); 
    
    } 


     /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($userId, $status)
    {      
        $status = ( $status == 1 ) ? 0 : 1;
        $this->user->status = $status;
        User::where('id', '=' , $userId )->update(['status' => $status]); 
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('user.Status Updated successfully!')]);
        
        $user=User::select(['first_name'])->where('id', $userId )->first();
        
        event(new InstantMailNotification($userId, [
            "code" =>  'forget_password',
            "args" => [
                'name' => $user->first_name,
               ]
        ]));

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
                'confirmButtonText' => __('user.Yes, delete it!'),
                'cancelButtonText' => __('user.No, cancel!'),
                'message' => __('user.Are you sure?'), 
                'text' => __('user.If deleted, You will be not able to adding this store with owner!')
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
        
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => __('user.Remove Store Delete Successfully!')]);

            return redirect(request()->header('Referer'));     
    } 


    
     /**
     * update application status
     *
     * @return response()
     */
    public function suspendedConfirm($user)
    {  
        return redirect(request()->header('Referer'));
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
