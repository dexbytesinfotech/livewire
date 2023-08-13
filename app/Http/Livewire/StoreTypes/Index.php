<?php

namespace App\Http\Livewire\StoreTypes;

use Livewire\Component;
use App\Http\DataTable\WithSorting;
use App\Http\DataTable\WithCachedRows;
use App\Http\DataTable\WithBulkActions;
use App\Http\DataTable\WithPerPagePagination;
use App\Http\DataTable\WithSingleAction;
use App\Http\DataTable\Column;
use App\Models\Stores\StoreType;

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
                "label" => __('components/StoreType.Name'),
                "field" => "name",
                "sortable" => false,
                "translate" => true,
               
            ]),
            Column::field([
                "label" => __('components/StoreType.Creation Date'),
                "field" => "created_at",
            ]),
            Column::field([
                "label" => __('components/StoreType.Status'),
                "field" => "status",
            ]),
            Column::field([
                "label" => implode(' | ',config('translatable.locales')),
                "field" => "id",
                "viewColumns" => false,
                "hidden" => count(config('translatable.locales')) > 1 ? false : true
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
                __('components/StoreType.Please select at least one store type!'),
            ]);
            return false;
        }
        $this->dispatchBrowserEvent("swal:destroyMultiple", [
            "action" => "deleteSelected",
            "type" => "warning",
            "confirmButtonText" => __('components/StoreType.Yes, delete it!'),
            "cancelButtonText" => __('components/StoreType.No, cancel!'),
            "message" => __('components/StoreType.Are you sure?'),
            "text" => __(
                'components/StoreType.If deleted, you will not be able to recover this store types!'
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
            __('components/StoreType.Store Type Delete Successfully!') . " -: " . $deleteCount,
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
     * Return a array of  all of the 's users with filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRowsQueryProperty()
    {   
        $query = StoreType::query()
            ->when(
                $this->filters["search"],
                fn($query, $search) => $query->WhereTranslationLike(
                    "name",
                    "%" . $search . "%"
                )
            );

            if(array_key_exists('status', $this->filters) && is_numeric($this->filters['status'])){ 
                $query->where('status' , '=' ,  $this->filters['status']);
            }  
            
        return $this->applySorting($query);
    }

    /**
     * Store query result in cache
     * Return a list of cache users of the application.
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
            ['type' => 'success',  'message' => __('components/StoreType.Store Type Delete Successfully!')]);    
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
        StoreType::where('id', $id )->update(['status' => $status]);
        
        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" =>
            __('components/StoreType.Status updated Successfully!'),
        ]);
   }

    /**
     * Show a list of all of the application's store type.
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view("livewire.store-types.index", [
            "StoreTypes" => $this->rows,
        ]);
    }
}