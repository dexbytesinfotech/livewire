<?php

namespace App\Http\Livewire\Devices;

use Livewire\Component;
use App\Models\Agencies\AgencyDevice;
use App\Models\Agencies\Agency;
use App\Models\Devices\Device;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class AssignAgency extends ModalComponent
{
    public $search;
    public $searchResultAgencies;
    public $selected_agency_id;
    public $deviceId;

    /**
     *
     * listeners
     */
    public $listeners = ['agencySubmit'];

    public function mount($deviceId)
    {
        $this->deviceId = $deviceId;
    }

    /**
     * reset field search and close modal
     */
    public function resetField (){ 
        $this->search = '';   
        $this->closeModal();      
    }

    /**
     * agency submit and assign to device
     */
    public function agencySubmit(){
        if(!$this->selected_agency_id) {
             $this->dispatchBrowserEvent('alert', 
             ['type' => 'success',  'message' => 'Please select a agency !']);
             return false;
        }
 
        $this->validate([ 
            'deviceId' => 'nullable',
            'selected_agency_id' => 'nullable', 
         ]);
           AgencyDevice::create([
            'device_id'=> $this->deviceId,
            'agency_id' =>$this->selected_agency_id,
            'status' => "assigned",
         ]);
         
         $this->resetField();
         $this->dispatchBrowserEvent('alert', 
         ['type' => 'success',  'message' => __('components/device.Agency assigned Successfully!')]);
         return redirect(request()->header('Referer'));
    }

    /**
     * updated search field
     */
    public function updatedSearch()
   {   
       $this->searchResultAgencies = "";
       $this->selected_agency_id = "";

       if($this->search) {
            $this->searchResultAgencies =  Agency::doesntHave('devices')->where(function($query){
                $query->where(DB::raw('lower(agency_name)'), 'like', '%'.$this->search.'%');
            })->get()->toArray(); 
       } else {
            $this->searchResultAgencies = collect();
       }

   }

   /**
    * selected agency code
    */
   public function selectedAgency($agencyId) {
        if($this->selected_agency_id  == $agencyId) {
            $this->selected_agency_id = "";
        } else {
            $this->selected_agency_id = $agencyId;
        }
   }
    
   /**
     * render the assign agencies modal window
     *
     */
    public function render()
    {
        return view('livewire.devices.assign-agency');
    }
}
