<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use App\Http\DataTable\WithSorting;
use App\Http\DataTable\WithCachedRows;
use App\Http\DataTable\WithBulkActions;
use App\Http\DataTable\WithPerPagePagination;
use App\Http\DataTable\WithSingleAction;
use App\Http\DataTable\Column;
use App\Models\Posts\Post;

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
    protected $defaultPages = ['about-us'];
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
                "label" => __('components/page.Title'),
                "field" => "title",
                'translate' => true,
                "sortable" => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/page.Slug'),
                "field" => "slug",
            ]),
            Column::field([
                "label" => __('components/page.Creation Date'),
                "field" => "created_at",
                'translate' => true,
                "sortable" => true,
                "direction" => true,
            ]),
            Column::field([
                "label" => __('components/page.Status'),
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
                __('components/pages.Please select at least one page'),
            ]);
            return false;
        }
        $this->dispatchBrowserEvent("swal:destroyMultiple", [
            "action" => "deleteSelected",
            "type" => "warning",
            "confirmButtonText" => __('components/pages.Yes, delete it!'),
            "cancelButtonText" => __('components/pages.No, cancel!'),
            "message" => __('components/pages.Are you sure?'),
            "text" => __(
                'components/pages.If deleted, you will not be able to recover this pages!'
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
            __('components/pages.Page Delete Successfully!') . " -: " . $deleteCount,
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
     * Return a array of  all of the 's page with filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRowsQueryProperty()
    {
        $query = Post::query()
            ->when(
                $this->filters["search"],
                fn($query, $search) => $query->WhereTranslationLike(
                    "title",
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
     * Return a list of cache page of the application.
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
            ['type' => 'success',  'message' => __('components/pages.Page Delete Successfully!')]);    
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
        $status = ( $status == "published") ? 'unpublished' : 'published';
        Post::where('id', $id )->update(['status' => $status]);      

        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" =>
            __('components/page.Status updated Successfully!'),
        ]);
   }

    /**
     * Show a list of all of the application's page.
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view("livewire.page.index", [
            "pages" => $this->rows,
        ]);
    }
}