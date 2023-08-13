<?php

namespace App\Http\Livewire\World\Country;

use Carbon\Carbon;
use Livewire\Component;
use App\Http\DataTable\Column;
use App\Models\Worlds\Country;
use App\Http\DataTable\WithSorting;
use App\Http\DataTable\WithCachedRows;
use App\Http\DataTable\WithBulkActions;
use App\Http\DataTable\WithSingleAction;
use App\Http\DataTable\WithPerPagePagination;

class Index extends Component
{
    use WithPerPagePagination, // Added perPage
        Column,
        WithSorting, // Added Sorting
        WithBulkActions, // Bulk actions
        WithCachedRows, // Improved return  response
        WithSingleAction; // delete on row item

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
     * Generic string-based column, attributes assigned
     *
     * @return array() response()
     */
    public function columns(): array
    {
        return [
            Column::field([
                "label" => __('components/country.Name'),
                "field" => "name",
                "sortable" => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/country.Country Code'),
                "field" => "country_code",
                "sortable" => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/country.Country Code Iso'),
                "field" => "country_ios_code",
                "sortable" => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/country.Creation Date'),
                "field" => "created_at",
            ]),
            Column::field([
                "label" => __('components/country.Status'),
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
                __('components/country.Please select at least one country'),
            ]);
            return false;
        }
        $this->dispatchBrowserEvent("swal:destroyMultiple", [
            "action" => "deleteSelected",
            "type" => "warning",
            "confirmButtonText" => __('components/country.Yes, delete it!'),
            "cancelButtonText" => __('components/country.No, cancel!'),
            "message" => __('components/country.Are you sure?'),
            "text" => __(
                'components/country.If deleted, you will not be able to recover this countries!'
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

        $this->selectedRowsQuery->delete();
        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" =>
            __('components/country.Country Delete Successfully!') . " -: " . $deleteCount,
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
     * Return a array of  all of the 's country with filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRowsQueryProperty()
    {
        $query = Country::query()
            ->when(
                $this->filters["search"],
                fn($query, $search) => $query->where(
                    "name", 
                    "like",
                    "%" . $search . "%"
                )
            )
            ->when(
                $this->filters["from_date"],
                fn($query, $date) => $query->whereDate(
                    "created_at",
                    ">=",
                    Carbon::parse($date)
                )
            )
            ->when(
                $this->filters["to_date"],
                fn($query, $date) => $query->whereDate(
                    "created_at",
                    "<=",
                    Carbon::parse($date)
                )
            );

            if(array_key_exists('status', $this->filters) && is_numeric($this->filters['status'])){ 
                $query->where('status' , '=' ,  $this->filters['status']);
            }   
        return $this->applySorting($query);
    }

    /**
     * Store query result in cache
     * Return a list of cache country of the application.
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
        $query = (clone $this->rowsQuery)->whereId($this->dltid)->delete();
        if ($query) {
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => __('components/country.Country Delete Successfully!')]);    
        }
        return $query;
    }


    /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($id, $status)
    {     
        $status = ( $status == 1 ) ? 0 : 1;
        Country::where('id', $id )->update(['status' => $status]);
        
        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" =>
            __('components/country.Status updated Successfully!'),
        ]);
   }

    /**
     * Show a list of all of the application's country.
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view("livewire.world.country.index", [
            "countrys" => $this->rows,
        ]);
    }
}