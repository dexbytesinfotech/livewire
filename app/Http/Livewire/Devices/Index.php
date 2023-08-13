<?php

namespace App\Http\Livewire\Devices;

use Livewire\Component;
use App\Http\DataTable\WithSorting;
use App\Http\DataTable\WithCachedRows;
use App\Http\DataTable\WithBulkActions;
use App\Http\DataTable\WithPerPagePagination;
use App\Http\DataTable\WithSingleAction;
use App\Http\DataTable\Column;
use App\Models\Devices\Device;
use App\Constants\DevicesStatus;
use App\Models\Agencies\AgencyDevice;

class Index extends Component
{
    use WithPerPagePagination, // Added perPage
        Column,
        WithSorting, // Added Sorting
        WithBulkActions, // Bulk actions
        WithCachedRows, // Improved return  response
        WithSingleAction; // delete on row item

    public $loadData = '';

    public $search ;
    public $searchResultAgencies ;
    public $selected_agency_id;
    public $deviceId ; 

    // Apply Filters
    public $filters = [
        "search" => "",
        "status" => "",
        "from_date" => "",
        "to_date" => "",
    ];

    // Event listeners are registered in the $listeners property of your Livewire components.
    protected $listeners = [
        "refreshTransactions" => '$refresh',
        "deleteSelected",
        "confirm",
        "removeAgency",
    ];

    /* Apply bootstrap layout in pagination */
    protected $paginationTheme = "bootstrap";

    public $account_status = "";

    public $allStatus = '';

    /**
    * Set initial data for the component.
    *
    */
    public function mount()
    {
        $deviceStatusObject = new DevicesStatus();
        $this->allStatus = $deviceStatusObject->getConstantsMessages();

        $this->searchResultAgencies = collect();
    }

    /**
     * Generic string-based column, attributes assigned
     *
     * @return array() response()
     */
    public function columns(): array
    {
        return [
            Column::field([
                "label" => __('components/device.Device Name'),
                "field" => "device_name",
                "sortable" => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/device.Device Model ID'),
                "field" => "device_model_id",
            ]),
            Column::field([
                "label" => __('components/device.Agency'),
                "field" => "agency_name",
            ]),
            Column::field([
                "label" => __('components/device.Driver'),
                "field" => "driver_name",
            ]),
            Column::field([
                "label" => __('components/device.Creation Date'),
                "field" => "created_at",
                "sortable" => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/device.Status'),
                "field" => "status",
            ]),
        ];
    }

    /**
     * The loadData action will be run immediately after the Livewire component renders on the page
     *
     * @return void()
     */
    public function init()
    {
        $this->loadData = true;
    }

    /**
     * Pass it to swal:destroyMultiple key of the alert configuration.
     *
     * @return void()
     */
    public function destroyMultiple()
    {
        $deleteCount = $this->selectedRowsQuery->count();
        if (!$deleteCount > 0) {
            $this->dispatchBrowserEvent("alert", [
                "type" => "error",
                "message" =>
                __('components/device.Please select at least one device'),
            ]);
            return false;
        }
        $this->dispatchBrowserEvent("swal:destroyMultiple", [
            "action" => "deleteSelected",
            "type" => "warning",
            "confirmButtonText" => __('components/device.Yes, delete it!'),
            "cancelButtonText" => __('components/device.No, cancel!'),
            "message" => __('components/device.Are you sure?'),
            "text" => __(
                'components/device.If deleted, you will not be able to recover this devices!'
            ),
        ]);
    }

    /**
     * Remove the selected blog from the storage.
     *
     * @return void()
     */
    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();
        
        $selectedDevices = $this->selectedRowsQuery->get();

        foreach ($selectedDevices as $device)
        {
            AgencyDevice::where('device_id', $device->id)->delete();
        }

        $this->selectedRowsQuery->delete();
        $this->selectPage = false;
        $this->selectAll = false;
        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" =>
            __('components/device.Device Deleted Successfully!') . " -: " . $deleteCount,
        ]);
        
    }

    /**
     * remove agency confirm code
     */
    public function removeAgencyConfirm($deviceId){
        $this->deviceId = $deviceId;
        $this->dispatchBrowserEvent("swal:confirm", [
            "action" => "removeAgency",
            "type" => "warning",
            "confirmButtonText" => __('components/device.Yes, remove it!'),
            "cancelButtonText" => __('components/device.No, cancel!'),
            "message" => __('components/device.Are you sure?'),
            "text" => __(
                'components/device.If removed, agency will be removed from this device!'),
        ]);
    }

    /**
     * agency remove code
     */
    public function removeAgency(){
        AgencyDevice::where('device_id',$this->deviceId)->delete();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => __('components/device.Agency Removed Successfully!')]);
    }

    /**
     * Clear the filter form and revert the results to default
     *
     * @return void()
     */
    public function resetFilters()
    {
        $this->reset("filters");
    }

    /**
     * Return a array of  all of the devices with filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRowsQueryProperty()
    {
        $query = Device::query()
        ->when($this->filters["search"], function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where("device_name", 'like', "%" . $search . "%")
                ->orWhere("device_model_id", 'like', "%" . $search . "%");
            });
        })
        ->when($this->filters["status"], function ($query, $status) {
            return $query->where("status", 'like', $status . "%");
        })
        ->with('agency')
        ->select('devices.*');
    
        return $this->applySorting($query);
    }

    /**
     * Store query result in cache
     * Return a list of cache device of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $this->dltid
     * @return \Illuminate\Http\Response
     */
    public function remove()
    {
        AgencyDevice::where('device_id',$this->dltid)->delete();
        $query = (clone $this->rowsQuery)->whereId($this->dltid)->delete();

        if ($query) {
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => __('components/device.Device Deleted Successfully!')]);    
        }
        return $query;
    }

   

    /**
     * Show a list of all of the application's devices.
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view("livewire.devices.index", [
            "devices" => $this->rows,
        ]);
    }
}