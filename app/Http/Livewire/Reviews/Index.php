<?php

namespace App\Http\Livewire\Reviews;

use App\Models\OrderReviews\OrderReview;
use App\Models\Stores\Store;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GlobalTrait;


class Index extends Component
{   
    use AuthorizesRequests;
    use WithPagination;
    use GlobalTrait;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $reviewId = '';
    public $filter = ['store_id' => null, 'receiver_id' => null, 'created_at' => null ];
    public $stores;
    public $customers;
    public $drivers;
    protected $listeners = ['remove'];
    protected $queryString = ['sortField', 'sortDirection'];
    protected $paginationTheme = 'bootstrap';

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
        $this->stores = Store::where('is_primary' , 0)->get(['id','name']);

        $this->drivers  = User::role('Driver')->get();

        if(auth()->user()->hasRole('Provider')){
            $this->filter['is_provider'] = true;
            $this->filter['store_id'] = $this->getStoreId();
        }
    }


     /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($reviewId)
    {
        $this->reviewId  = $reviewId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this review data!'
            ]);
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        OrderReview::find($this->reviewId)->delete();

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Review Delete Successfully!', 
                'text' => 'It will not list on reviews table soon.'
            ]);
    }  

    public function render()
    {
        return view('livewire.reviews.index',[
            'orderReviews' => OrderReview::with(['order', 'order.store', 'sender', 'receiver'])->searchMultipleOrderReview(trim(strtolower($this->search)), $this->filter)->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
}
