<?php

namespace App\Http\Livewire\Order;

use App\Models\Order\Order;
use App\Models\Stores\Store;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\GlobalTrait;
use App\Constants\OrderStatusLabel;
use App\Constants\OrderStatus;



class Index extends Component
{  
    use AuthorizesRequests;
    use WithPagination;
    use GlobalTrait;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = '';
    public $currency = '';
    public $filter = ['store_id' => null, 'created_at' => null, 'order_status' => null];
    public $deleteId = '';
    public $orderId = '';
    public $orderStatus = '';
    public $statusLabels;
    public $allOrderStatus = '';
    public $stores;

    protected $listeners = ['remove', 'confirm'];

    protected $queryString = ['sortField', 'sortDirection', 'orderStatus'];
    protected $paginationTheme = 'bootstrap';
    
 
    public function mount() {
        $this->perPage = config('commerce.pagination_per_page');
        $this->currency = config('commerce.price');
        $this->filter['orderStatus'] = $this->orderStatus;
        $this->filter['order_status'] = $this->orderStatus;
        
        $this->stores = Store::where('is_primary' , 0)->get(['id','name']);

        if(auth()->user()->hasRole('Provider')){
            $this->filter['is_provider'] = true;
            $this->filter['store_id'] = $this->getStoreId();
        }
        
        $orderStatusLabelConstant = new OrderStatusLabel();
        $this->statusLabels = $orderStatusLabelConstant->getConstants();

        $orderStatusConstant = new OrderStatus();
        $this->allOrderStatus = $orderStatusConstant->getConstants();
        
    }

  
    public function sortBy($field){
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

      /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($productId)
    {
        $this->deleteId  = $productId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this product!'
            ]);
    }   
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        order::find($this->deleteId)->delete();

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Order Delete Successfully!', 
                'text' => 'It will not list on order table soon.'
            ]);
    }
 
    public function render()
    {   
        // dd(Order::searchMultipleOrder($this->search, $this->filter)->orderBy($this->sortField, $this->sortDirection)->getBindings());
        return view('livewire.order.index',[
             'orders' => Order::searchMultipleOrder(trim(strtolower($this->search)), $this->filter)->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
            
    /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($orderId, $status)
    {        
        
    }

}
