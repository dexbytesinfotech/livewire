<?php

namespace App\Http\Livewire\Agencies;

use App\Models\Agencies\Agency;
use App\Models\Agencies\AgencyUser;
use App\Models\User;
use App\Models\Worlds\Cities;
use App\Models\Worlds\Country;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Constants\Roles;

class Edit extends Component
{
    public Agency $agency;
    
    use AuthorizesRequests;

    public $cities = '';
    public $agencyId = '';
    public $userId = '';
    public $deleteId = '';
    public $countries = '';
    public $country_code = '';    
    public $passwordConfirmation = '';
    public $usersWithManagerRole = '';

    /**
     * listeners
     */
    protected $listeners = [
        'remove','managerRemove','updateShowManagers'
        ];

    /**
     * List of add/edit form rules
     */
    protected function rules(){

        return [
            'agency.agency_name' => 'required|string|max:100|min:3|regex:/^[a-zA-Z0-9 ]+$/|unique:App\Models\Agencies\Agency,agency_name,'.$this->agency->id,   
            'agency.phone_number' => 'required|numeric|digits:10|regex:/^\+?[1-9][0-9]{7,14}$/',  
            'agency.city' => 'required|max:50|min:3',
            'agency.address' => 'required|max:100|min:3',
            'agency.country_code' => 'required',
        ];
    }


    public function _getAgents(){
        $this->usersWithManagerRole = Agency::find($this->agencyId)->users()->get();
    }

    public function updateShowManagers(){
        $this->_getAgents();
    }
    
    /**
    * Set initial data for the component.
    *
    */
    public function mount($id)
    {
        $this->agencyId = $id;
        $this->cities = Cities::all();
        $this->countries = Country::all();
        $this->country_code = Country::where('is_default', 1)->value('country_code');

        $this->agency = Agency::find($id);
        $this->_getAgents();
 
    }   
    /**
    * Validate the updated property.
    *
    */
    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    /**
     * update the agency data
     * @return void
     */
    public function edit(){
        $this->validate([
            'agency.agency_name' => 'required|string|max:100|min:3|regex:/^[a-zA-Z0-9 ]+$/|unique:App\Models\Agencies\Agency,agency_name,'.$this->agency->id,   
            'agency.phone_number' => 'required|numeric|digits:10|regex:/^\+?[1-9][0-9]{7,14}$/',  
            'agency.city' => 'required|max:50|min:3',
            'agency.address' => 'required|max:100|min:3',
            'agency.country_code' => 'required',
        ]);   
        $this->agency->update();
        
        return redirect(route('agency-management'))->with('status',__('components/agency.Agency Updated Successfully!'));
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
        ['type' => 'success',  'message' => __('components/agency.Status Updated Successfully!')]);     

   }

     /**
     * destroy agency manager confirm message show
     *
     * @return response()
     */
    public function destroyManagerConfirm($userId)
    {
        $this->deleteId  = $userId;

        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'managerRemove',
                'type' => 'warning',  
                "confirmButtonText" => __('components/agency.Yes, delete it!'),
                "cancelButtonText" => __('components/agency.No, cancel!'),
                "message" => __('components/agency.Are you sure?'),
                "text" => __('components/agency.If deleted, you will not be able to recover this agency manager!'),
                ]);
    }

    /**
     * destroy agency manager remove Method
     *
     * @return response()
     */
    public function managerRemove()
    {
        AgencyUser::where('user_id', $this->deleteId)->delete();
        User::find($this->deleteId)->delete();

        $this->_getAgents();

        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => __('components/agency.Agency Manager Deleted Successfully!')]);
    }
   /**
     * destroy agency confirm message show
     *
     * @return response()
     */
    public function destroyConfirm($agencyId)
    {
        $this->deleteId  = $agencyId;
        
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                "confirmButtonText" => __('components/agency.Yes, delete it!'),
                "cancelButtonText" => __('components/agency.No, cancel!'),
                "message" => __('components/agency.Are you sure?'),
                "text" => __(
                    'components/agency.If deleted, you will not be able to recover this agencies!'),
            ]);
    }

    /**
     * destroy agency remove Method
     *
     * @return response()
     */
    public function remove()
    {
        $this->usersWithManagerRole = Agency::find($this->agencyId)->users()->whereHas('roles', function ($query) {
            $query->where('name', Roles::AGENT);
        })->delete();

        AgencyUser::where('agency_id', $this->agencyId)
                ->update(['deleted_at' => now()]);

        Agency::find($this->deleteId)->delete();

        return redirect(route('agency-management'))->with('status',__('components/agency.Agency Deleted Successfully!'));
    }  

    /**
     * update account status
     *
     * @return response()
     */
    public function suspendedConfirm($agency)
    {   
        $this->agencyId = $agency["id"];
        $account_status = ( $agency['account_status'] == 'suspended' ) ? 'approved' : 'suspended';
        $status = ( $account_status == 'suspended'  ) ? 0 : 1;
        Agency::where('id', '=' , $agency['id'])->update(['account_status' => $account_status, 'status' => $status]);      
        $this->agency['account_status'] = $account_status;
    
   }


    /**
     * render the agency edit form
     *
     */
    public function render()
    {
        return view('livewire.agencies.edit');
    }
}
