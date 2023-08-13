<?php

namespace App\Http\Livewire\Devices;

use App\Models\Devices\Device;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Constants\DevicesStatus;

class Edit extends Component
{
    public Device $device;
    use AuthorizesRequests;
    public $allStatus = '';

    /**
     * List of add/edit form rules
     */
    protected function rules(){

        return [
            'device.device_name' => 'required|string|max:100|min:3|regex:/^[a-zA-Z0-9 ]+$/',
            'device.device_model_id' => 'required|alpha_num|max:50|min:3|unique:App\Models\Devices\Device,device_model_id,'.$this->device->id,
            'device.note' => 'nullable|max:600|min:3',
            'device.status' => 'required',
        ];
    }

    /**
    * Set initial data for the component.
    *
    */
    public function mount($id){

        $deviceStatusObject = new DevicesStatus();
        $this->allStatus = $deviceStatusObject->getConstantsMessages();

        $this->device = Device::find($id);
        
    }

    /**
    * Validate the updated property.
    *
    */
    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    /**
     * update the device data
     * @return void
     */
    public function edit(){
        $this->validate([
            'device.device_name' => 'required|string|max:100|min:3|regex:/^[a-zA-Z0-9 ]+$/',
            'device.device_model_id' => 'required|alpha_num|max:50|min:3|unique:App\Models\Devices\Device,device_model_id,'.$this->device->id,     
            'device.note' => 'nullable|max:600|min:3',
            'device.status' => 'required',
        ]);   
        $this->device->update([
            'device_name'     => $this->device['device_name'],
            'device_model_id' => strtoupper($this->device['device_model_id']),
            'note'            => $this->device['note'],
            'status'          => $this->device['status'],
        ]);
        return redirect(route('device-management'))->with('status',__('components/device.Device Updated Successfully!'));
    }

    /**
     * render the device edit form
     *
     */
    public function render()
    {
        return view('livewire.devices.edit');
    }
}
