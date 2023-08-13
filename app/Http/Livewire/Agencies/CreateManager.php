<?php

namespace App\Http\Livewire\Agencies;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use App\Models\Agencies\AgencyUser;
use App\Models\Worlds\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Constants\Roles;

class CreateManager extends ModalComponent
{
    public $agencyId = '';
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $passwordConfirmation = '';
    public $countries = '';
    public $country_code = '';
    
    use AuthorizesRequests;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    
    /**
     * List of add/edit form rules
     */
    protected function rules(){
        return [
            'first_name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
            'last_name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|email|unique:App\Models\User,email',
            'phone' => 'required|numeric|digits:10|unique:App\Models\User,phone',
            'password' => 'required|min:7',
            'passwordConfirmation' => 'required|same:password',
            'country_code' => 'required',
        ];
    }

    /**
    * Set initial data for the component.
    *
    */
    public function mount($agencyId)
    {
        $this->agencyId = $agencyId;
        $this->countries = Country::all();
        $this->country_code = Country::where('is_default', 1)->value('country_code');
    }

    /**
    * Validate the updated property.
    *
    */
    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

     /**
      * store the agency manager data 
      * @return void
      */
    public function store()
    {
       
        $this->validate();
        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country_code' => $this->country_code,
            'password' => Hash::make($this->password),
        ]);

        AgencyUser::create([
            'user_id' => $user->id,
            'agency_id' => $this->agencyId,
        ]);

        $user->assignRole(Roles::AGENT);
        $this->emit('updateShowManagers');

        $this->closeModal();
        
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('components/agency.Agency Manager Created Successfully!')]);     
        
    }

    /**
     * render the agency manager form
     *
     */
    public function render()
    {
        return view('livewire.agencies.create-manager');
    }
}
