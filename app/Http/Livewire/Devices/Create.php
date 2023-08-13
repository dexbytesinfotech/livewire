<?php

namespace App\Http\Livewire\Devices;

use App\Models\Devices\Device;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Constants\DevicesStatus;

class Create extends Component
{
    use AuthorizesRequests;
    public $device_name='';
    public $note = '';
    public $allStatus= '';
    public $status = '';
    public $device_model_id='';
    public $role = '';

    /**
     * render the create devices form
     *
     */
    public function render()
    {
        return view('livewire.devices.create');
    }

    /**
     * List of add/edit form rules
     * 
     */
    protected $rules=[
        'device_name' => 'required|string|max:100|min:3|regex:/^[a-zA-Z0-9 ]+$/',
        'device_model_id' => 'required|alpha_num|min:5|max:50|unique:App\Models\Devices\Device,device_model_id',      
        'note' => 'nullable|max:600|min:3',
        'status' => 'required',
    ];

    /**
    * Validate the updated property.
    *
    */
    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 

    /**
    * Set initial data for the component.
    *
    */
    public function mount(){
        $deviceStatusObject = new DevicesStatus();
        $this->allStatus = $deviceStatusObject->getConstantsMessages();
    }

    /**
      * store the device data in the devices table
      * @return void
      */
    public function store()
    {
        $this->validate();

        $device = Device::create([
            'device_name'     => $this->device_name,
            'device_model_id' => strtoupper($this->device_model_id),
            'note'            => $this->note,
            'status'          => $this->status,
        ]);
        
        return redirect(route('device-management'))->with('status',__('components/device.Device Created Successfully'));
    }

}

