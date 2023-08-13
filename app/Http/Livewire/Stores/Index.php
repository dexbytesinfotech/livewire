<?php

namespace App\Http\Livewire\Stores;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Http\DataTable\WithSorting;
use App\Http\DataTable\WithCachedRows;
use App\Http\DataTable\WithBulkActions;
use App\Http\DataTable\WithPerPagePagination;
use Spatie\Permission\Models\Role;
use App\Http\DataTable\WithSingleAction;
use App\Http\DataTable\Column;
use App\Models\Stores\Store;
use App\Models\Stores\StoreType;
use Illuminate\Support\Facades\DB;

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
        "application_status" => "",
        "store_type" => "",
        "from_date" => "",
        "to_date" => "",
    ];

    // Event listeners are registered in the $listeners property of your Livewire components.
    protected $listeners = [
        "refreshTransactions" => '$refresh',
        "deleteSelected",
        "confirm",
        "confirmApplication",
    ];

    /* Apply bootstrap layout in pagination */
    protected $paginationTheme = "bootstrap";

    public $roles;
    public $account_status = "";
    public $application_status;
    public $StoreTypes;
    public $actionStatus = '';
    public $storeId = '';

    protected $queryString = ['application_status'];

    /**
     * Generic string-based column, attributes assigned
     *
     * @return array() response()
     */
    public function columns(): array
    {
        return [
            Column::field([
                "label" => __('components/store.Photo'),
                "field" => "logo_path",
                'hidden' => true
            ]),
            Column::field([
                "label" => __('components/store.Name'),
                "field" => "name",
                "sortable" => true,
                'translate' => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/store.Email'),
                "field" => "email",
            ]),
            Column::field([
                "label" => __('components/store.Phone'),
                "field" => "phone",
            ]),
            Column::field([
                "label" => __('components/store.Status'),
                "field" => "status",
            ]),
            Column::field([
                "label" => implode(' | ',config('translatable.locales')),
                "field" => "id",
                "viewColumns" => false,
                "hidden" => count(config('translatable.locales')) > 1 ? false : true
            ]),
            Column::field([
                "label" => __('components/store.Creation Date'),
                "field" => "created_at",
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
    public function mount() {  
        $this->filters['application_status'] = $this->application_status; 

        $this->filters['store_type'] = $this->StoreTypes;   
        $this->StoreTypes = StoreType::withTranslation()->get();
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
                __('components/store.Please select at least one store'),
            ]);
            return false;
        }
        $this->dispatchBrowserEvent("swal:destroyMultiple", [
            "action" => "deleteSelected",
            "type" => "warning",
            "confirmButtonText" => __('components/store.Yes, delete it!'),
            "cancelButtonText" => __('components/store.No, cancel!'),
            "message" => __('components/store.Are you sure?'),
            "text" => __(
                'components/store.If deleted, you will not be able to recover this stores!'
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
            __('components/store.Store Delete Successfully!') . " -: " . $deleteCount,
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
        $query = Store::query()->searchMultipleStore($this->filters);
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
            ['type' => 'success',  'message' => __('components/store.Store Delete Successfully!')]);    
        }
        return $query;
    }


    /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($store_id, $status)
    {     
        $status = ( $status == 1 ) ? 0 : 1;
        Store::where('id', $store_id )->update(['status' => $status]);

        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" =>
            __('components/store.Status updated Successfully!'),
        ]);
   }

    /**
     * Show a list of all of the application's users.
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view("livewire.store.index", [
            "stores" => $this->rows,
        ]);
    }


     /**
     * Write code on Method
     *
     * @return response()
     */
    public function applicationConfirm($storeId, $status)
    {   
        $this->storeId  = $storeId;
        $this->actionStatus = $status;

        $this->dispatchBrowserEvent('swal:confirmApplication', [
                'action' => 'confirmApplication',
                'type' => 'warning',  
                'confirmButtonText' =>  $status == 'approved' ? __('store.Yes, approve it!') : __('store.Yes reject it'),
                'cancelButtonText' => __('store.No, cancel!'),
                'message' => $status == 'approved' ? __('store.Are you approve?') : __('store.Are you Reject'), 
                 'text' =>  $status == 'approved' ?  __('store.If approved, store will be listed in store sections!') : __('store.If rejected, store will be not listed in store sections!')
            ]);
    }


     /**
     * Write code on Method
     *
     * @return response()
     */
    public function confirmApplication()
    {     
        Store::where('id', $this->storeId )->update(['application_status' => $this->actionStatus]);
       
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => $this->actionStatus == 'approved' ? __('store.Store Application Approved Successfully!') : __('store.Store Application Rejected'), 
        ]);
    }

    /**
     * update searchable status
     *
     * @return response()
     */
    public function searchableConfirm($store)
    {        
        $is_searchable = ( $store['is_searchable'] == 1 ) ? 0 : 1;
        Store::where('id', $store['id']  )->update(['is_searchable' => $is_searchable]);     
        
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('store.Search Status Updated Successfully!')]);
   }

    /**
     * update featured status
     *
     * @return response()
     */
    public function featuresConfirm($store)
    {  
        $is_features = ( $store['is_features'] == 1 ) ? 0 : 1;
        Store::where('id', $store['id']  )->update(['is_features' => $is_features]);      
        
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('store.Top Store Updated Successfully!')]);
   }
}