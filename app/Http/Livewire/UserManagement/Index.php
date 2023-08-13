<?php

namespace App\Http\Livewire\UserManagement;

use App\Events\InstantMailNotification;
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
        "role" => "",
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

    public $loadData = '';
    public $roles;
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
                "label" => __('components/user.Photo'),
                "field" => "profile_photo",
                "sortable" => true,
                "direction" => true,
                "hidden" => true,
            ]),
            Column::field([
                "label" => __('components/user.Name'),
                "field" => "name",
                "sortable" => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/user.Email'),
                "field" => "email"
            ]),
            Column::field([
                "label" => __('components/user.Phone'),
                "field" => "phone",
            ]),
            Column::field([
                "label" => __('components/user.Role'),
                "field" => "role",
            ]),
            Column::field([
                "label" => __('components/user.Status'),
                "field" => "status",
            ]),
            Column::field([
                "label" => __('components/user.Creation Date'),
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

    public function mount($role = "")
    {
        $this->filters["role"] = $role;
        $this->roles = Role::where("status", 1)->get(["id", "name"]);
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
                __('components/user.Please select at least one user'),
            ]);
            return false;
        }
        $this->dispatchBrowserEvent("swal:destroyMultiple", [
            "action" => "deleteSelected",
            "type" => "warning",
            "confirmButtonText" => __('components/user.Yes, delete it!'),
            "cancelButtonText" => __('components/user.No, cancel!'),
            "message" => __('components/user.Are you sure?'),
            "text" => __(
                'components/user.If deleted, you will not be able to recover this users!'
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
            __('components/user.User Delete Successfully!') . " -: " . $deleteCount,
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
        $query = User::query()
        ->when($this->filters["search"], function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where("first_name", 'like', "%" . $search . "%")
                ->orWhere("last_name", 'like', "%" . $search . "%");
            });
        })
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
        )
        ->when(
            $this->filters["role"],
            fn($query, $role) => $query->whereHas("roles", function (
                $query
            ) use ($role) {
                $query->where("name", "=", ucfirst($role));
            })
        )
        ->with(["roles"]);
            

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
            ['type' => 'success',  'message' => __('components/user.User Delete Successfully!')]);    
         }
         return $query;
    }


    /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($userId, $status)
    {     
        $status = ( $status == 1 ) ? 0 : 1;
        User::where('id', $userId )->update(['status' => $status]);
        
        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" =>
            __('components/user.Status updated Successfully!'),
        ]);
   }

    /**
     * Show a list of all of the application's users.
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view("livewire.user-management.index", [
            "users" => $this->rows,
        ]);
    }
}