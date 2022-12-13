<?php

namespace App\Http\Livewire\Account\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        'user.name' => 'required',
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
        return back()->withStatus('Profile successfully updated.');
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
                return back()->with(['success'=>'Password successfully updated.']);
            }
            else{
                return back()->with(['error' =>"New password can not be the old password!"]);
            } 
        }
        else{
            return back()->with(['error' =>"Old password doesn't match"]);
        }
    } 


    /**
     * update store status
     *
     * @return response()
     */
    public function updatedProfilePhoto()
    {        
        $this->validate([
            'profile_photo' => 'required|mimes:jpg,jpeg,png|max:1024',
        ]);
          
        $profile_photo = $this->profile_photo->store('profile', config('app_settings.filesystem_disk.value'));
        User::where('id', '=' , $this->user->id )->update(['profile_photo' => $profile_photo]);  
        
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Profile photo Updated Successfully!']);

   }

    public function render()
    {
        return view('livewire.account.profile');
    }
}
