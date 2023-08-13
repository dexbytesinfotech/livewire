<?php

namespace App\Http\Livewire\TicketCategories;

use App\Models\Tickets\TicketCategory;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Index extends Component
{   
    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $perPage = 10;
    
    public $deleteId = '';
    
    protected $listeners = ['remove'];
    protected $queryString = ['sortField', 'sortDirection'];
    protected $paginationTheme = 'bootstrap';

    public bool $loadData = false;
  
    public function init()
    {
         $this->loadData = true;
    }

    public function sortBy($field){
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function mount() {
        $this->perPage = config('commerce.pagination_per_page');
    }

    public function render()
    {
        return view('livewire.ticket-categories.index', [
            'ticketCategories' =>$this->loadData ? TicketCategory::searchMultipleTicketCategory($this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage) : [],
        ]);
    }
     
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        TicketCategory::find($this->deleteId)->delete();
      
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => __('TicketCategories.Ticket Category Delete Successfully!')]);
    } 


    public function updatingSearch()
    {
        $this->gotoPage(1);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }   
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($tagId)
    {
        $this->deleteId  = $tagId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => __('TicketCategories.Yes, delete it!'),
                'cancelButtonText' => __('TicketCategories.No, cancel!'),
                'message' => __('TicketCategories.Are you sure?'), 
                'text' => __('TicketCategories.If deleted, you will not be able to recover this ticket category data!')
            ]);
    }

}
