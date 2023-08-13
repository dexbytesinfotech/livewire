<?php

namespace App\Http\Livewire\Agencies;

use Livewire\Component;
use App\Http\DataTable\WithSorting;
use App\Http\DataTable\WithCachedRows;
use App\Http\DataTable\WithBulkActions;
use App\Http\DataTable\WithPerPagePagination;
use App\Http\DataTable\WithSingleAction;
use App\Http\DataTable\Column;
use App\Models\Agencies\Agency;
use App\Models\User;
use App\Models\Agencies\AgencyUser;

class Index extends Component
{
    use WithPerPagePagination, // Added perPage
        Column,
        WithSorting, // Added Sorting
        WithBulkActions, // Bulk actions
        WithCachedRows, // Improved return  response
        WithSingleAction; // delete on row item

        public $loadData = '';

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
    ];

    /* Apply bootstrap layout in pagination */
    protected $paginationTheme = "bootstrap";

    public $account_status = "";


    /**
    * Set initial data for the component.
    *
    */
    public function mount()
    {
        
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
                "label" => __('components/agency.Agency Name'),
                "field" => "agency_name",
                "sortable" => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/agency.Phone Number'),
                "field" => "phone_number",
            ]),
            Column::field([
                "label" => __('components/agency.Status'),
                "field" => "status",
            ]),
            Column::field([
                "label" => __('components/agency.Creation Date'),
                "field" => "created_at",
                "sortable" => true,
                "direction" => true,
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
                __('components/agency.Please select at least one agency'),
            ]);
            return false;
        }
        $this->dispatchBrowserEvent("swal:destroyMultiple", [
            "action" => "deleteSelected",
            "type" => "warning",
            "confirmButtonText" => __('components/agency.Yes, delete it!'),
            "cancelButtonText" => __('components/agency.No, cancel!'),
            "message" => __('components/agency.Are you sure?'),
            "text" => __('components/agency.If deleted, you will not be able to recover this agencies!'),
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
        $selectedAgencies = $this->selectedRowsQuery->get();

        foreach ($selectedAgencies as $agency) {
            $managerUsers = $agency->users()
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'Manager');
                })
                ->get(); 
            foreach ($managerUsers as $managerUser) {
                $managerUser->delete();
            }
            AgencyUser::where('agency_id', $agency->id)
                ->whereIn('user_id', $managerUsers->pluck('id'))
                ->update(['deleted_at' => now()]);
        }    
        
        $this->selectedRowsQuery->delete();
        $this->selectPage = false;
        $this->selectAll = false;
        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" =>
            __('components/agency.Agency Deleted Successfully!') . " -: " . $deleteCount,
        ]);
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
     * Return a array of  all of the agencies with filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRowsQueryProperty()
    {
        $query = Agency::query()
        ->when($this->filters["search"], function ($query, $search) {
            $query->where("agency_name", 'like', "%" . $search . "%");
        });

        return $this->applySorting($query);
    }

    /**
     * Store query result in cache
     * Return a list of cache agency of the application.
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
        Agency::find($this->dltid)->users()->whereHas('roles', function ($query) {
            $query->where('name', 'Manager');
        })->delete();
        AgencyUser::where('agency_id', $this->dltid)
                ->update(['deleted_at' => now()]);
        $query = (clone $this->rowsQuery)->whereId($this->dltid)->delete();
        if ($query) {
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => __('components/agency.Agency Deleted Successfully!')]);    
        }
        return $query;
    }

    /**
     * update agency status
     *
     * @return response()
     */
    public function statusAccountUpdate($agencyId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        Agency::where('id', '=' , $agencyId )->update(['status' => $status]);

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('components/agency.Status Updated Successfully!')]);     

   }

    /**
     * Show a list of all of the application's agencies.
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view("livewire.agencies.index", [
            "agencies" => $this->rows,
        ]);
    }
}


