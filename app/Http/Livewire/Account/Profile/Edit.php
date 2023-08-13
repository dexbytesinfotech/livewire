<?php

namespace App\Http\Livewire\Account\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Edit extends Component
{

    use WithFileUploads;

    public User $user;
    public $profile_photo;
    public $confirmationPassword='';
    public $new_password="";
    public $old_password='';

    protected function rules(){
    return [
        'user.first_name' => 'required',
        'user.email' => 'required|email|unique:users,email,'.$this->user->id,
        'user.phone' => 'required|max:12'
    ];
}

    public function mount() { 
        $this->user = auth()->user();
        $this->user->phone = substr($this->user->phone , +(strlen($this->user->country_code)));
      
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);

    }

    public function update()
    {
        $this->validate();
        $this->user->phone  = $this->user->country_code.$this->user->phone ;
        $this->user->save();
        
        $this->user->phone = substr($this->user->phone , +(strlen($this->user->country_code)));
        return back()->withStatus(__('account.Profile successfully updated'));
    }


    public function passwordUpdate(){

        $this->validate([ 
            'old_password' => 'required',
            'new_password' => 'required|min:7|same:confirmationPassword',
        ]);

  
        $hashedPassword = auth()->user()->password;

        if (Hash::check($this->old_password , $hashedPassword)) {
            if (!Hash::check($this->new_password , $hashedPassword))
            {
                $users = User::findorFail(auth()->user()->id);
                $users->password = $this->new_password;
                $users->save();
                return back()->with(['success'=> __('account.Password successfully updated')]);
            }
            else{
                return back()->with(['error' =>__('account.New password can not be the old password')]);
            } 
        }
        else{
            return back()->with(['error' =>__("account.Old password doesn't match")]);
        }
    } 


    /**
     * update store status
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
        Storage::disk(config('app_settings.filesystem_disk.value'))->put('users'.'/'.$fileName, (string) $img->encode());
        
        $img->resize(170, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();                       
        });
        Storage::disk(config('app_settings.filesystem_disk.value'))->put('thumbnails'.'/'.$fileName, $img->stream());
        $uploaded_path = 'thumbnails'.'/'.$fileName;
        User::where('id', '=' , $this->user->id )->update(['profile_photo' => $uploaded_path]);

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('account.Profile photo updated successfully!')]);
   }

    public function render()
    {
        return view('livewire.account.profile');
    }
}
