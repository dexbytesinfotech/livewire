<?php

namespace App\Http\Livewire\Tickets;

use Carbon\Carbon;
use Livewire\Component;
use App\Http\DataTable\Column;
use App\Models\Tickets\Ticket;
use App\Constants\TicketsStatus;
use App\Http\DataTable\WithSorting;
use App\Http\DataTable\WithCachedRows;
use App\Http\DataTable\WithBulkActions;
use App\Http\DataTable\WithSingleAction;
use Illuminate\Database\Eloquent\Builder;
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

    public $statusList;
    public $new_status;

    /**
     * Generic string-based column, attributes assigned
     *
     * @return array() response()
     */
    public function columns(): array
    {
        return [
            Column::field([
                "label" => __('components/ticket.Title'),
                "field" => "title",
            ]),
            Column::field([
                "label" => __('components/ticket.Customer Name'),
                "field" => "user_id",
            ]),
            Column::field([
                "label" => __('components/ticket.Creation Date'),
                "field" => "created_at",
                "sortable" => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/ticket.Status'),
                "field" => "status",
            ]),
        ];
    }
    public function mount($status="") {
        $this->filters['status'] = $status;
        $statusConst = new TicketsStatus();
        $this->statusList =  $statusConst->getConstants();
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
                __('components/ticket.Please select at least one ticket'),
            ]);
            return false;
        }
        $this->dispatchBrowserEvent("swal:destroyMultiple", [
            "action" => "deleteSelected",
            "type" => "warning",
            "confirmButtonText" => __('components/ticket.Yes, delete it!'),
            "cancelButtonText" => __('components/ticket.No, cancel!'),
            "message" => __('components/ticket.Are you sure?'),
            "text" => __(
                'components/ticket.If deleted, you will not be able to recover this tickets!'
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
            __('components/ticket.Ticket Delete Successfully!') . " -: " . $deleteCount,
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
     * Return a array of  all of the 's ticket with filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRowsQueryProperty()
    {   
        $query = Ticket::query()
            ->when(
                $this->filters["search"],
                fn($query, $search) => $query->where(
                    "title", "like",
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
            )->
            with(['user', 'category']);
            if(array_key_exists('status', $this->filters) && !empty($this->filters['status'])){ 
                $query->where('status' , '=' ,  $this->filters['status']);
            } 
       
        return $this->applySorting($query);
    }

    /**
     * Store query result in cache
     * Return a list of cache ticket of the application.
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
            ['type' => 'success',  'message' => __('components/ticket.Ticket Delete Successfully!')]);    
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
        Ticket::where('id', $id )->update(['status' => $status]);
        
        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" =>
            __('components/ticket.Status updated Successfully!'),
        ]);
   }

    /**
     * Show a list of all of the application's ticket.
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view("livewire.tickets.index", [
            "tickets" => $this->rows,
        ]);
    }
}