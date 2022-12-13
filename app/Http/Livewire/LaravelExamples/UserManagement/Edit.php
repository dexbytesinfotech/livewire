<?php

namespace App\Http\Livewire\LaravelExamples\UserManagement;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public User $user;

    public $picture;
    public $roles;
    public $password='';
    public $confirmPassword='';

    protected function rules(){
        return [
            'user.email' => 'required|email|unique:users,email,'.$this->user->id,
            'user.name' =>'required|',
            'password' => 'same:confirmPassword|min:7',
            'user.role_id' => 'required|exists:roles,id',
        ];
    }

    public function mount($id) {

        $this->user = User::find($id);
        $this->roles = Role::get(['id','name']);
    }

    public function update(){
        
        $this->validate();
    
        if (env('IS_DEMO') && in_array($this->user->id, [1, 2, 3])){

            $demoEmail = User::find($this->user->id);

            if($this->password == "" && $demoEmail->email == $this->user->email){

                if ($this->picture){
                    $this->validate([
                        'picture' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096',
                    ]);
                    $currentAvatar = User::find($this->user->id)->picture;
        
                    if($currentAvatar !== 'profile/avatar.jpg' && $currentAvatar !== 'profile/avatar2.jpg' && $currentAvatar !== 'profile/avatar3.jpg' && !empty($currentAvatar)){
        
                        unlink(storage_path('app/public/'.$currentAvatar));
                        $this->user->update([
                            'picture' => $this->picture->store('profile', 'public')
                        ]);
                    }
                    else{
                        $this->user->update([
                            'picture' => $this->picture->store('profile', 'public')
                        ]);
                    }
                }
        
                $this->user->save();
        
                return redirect(route('user-management'))->with('status', 'User successfully updated.');
            }

            return back()->with('demo', "You are in a demo version. You are not allowed to change the email or password for a default user." );
        }

        if ($this->picture){
            $this->validate([
                'picture' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096',
            ]);
            $currentAvatar = $this->user->picture;

            if($currentAvatar !== 'profile/avatar.jpg' && $currentAvatar !== 'profile/avatar2.jpg' && $currentAvatar !== 'profile/avatar3.jpg' && !empty($currentAvatar)){

                unlink(storage_path('app/public/'.$currentAvatar));
                $this->user->update([
                    'picture' => $this->picture->store('profile', 'public')
                ]);
            }
            else{
                $this->user->update([
                    'picture' => $this->picture->store('profile', 'public')
                ]);
            }
        }

        $this->user->save();

        return redirect(route('user-management'))->with('status', 'User successfully updated.');
    }

    public function render()
    {
        $this->authorize('manage-users', User::class);
        
        return view('livewire.laravel-examples.user-management.edit');
    }
}
