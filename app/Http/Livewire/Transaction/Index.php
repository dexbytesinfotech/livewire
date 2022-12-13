<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Order\Transaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\GlobalTrait;
use App\Constants\OrderPaymentStatus;
use App\Models\Stores\Store;

class Index extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    use GlobalTrait;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = '';
    public $product = '';
    public $currency = '';
    public $filter = ['status' => null, 'store_id'=>null, 'created_at'=> null];
    
    
    public $transactionId = '';
    public $startDate = '' ;
    public $endDate = ''  ;

    public $allPaymentStatus;
    public $stores;
     
    

    protected $listeners = ['remove', 'confirm','statusUpdateChange','removeMultiple' ];

    protected $queryString = ['sortField', 'sortDirection','startDate','endDate'];
    protected $paginationTheme = 'bootstrap';
    
 
    public function mount() {
        
        if(auth()->user()->hasRole('Provider')){
            $this->filter['is_provider'] = true;
            $this->filter['store_id'] = $this->getStoreId();
        }
        $this->filter['startDate'] = $this->startDate;
        $this->filter['endDate'] = $this->endDate;
        $this->perPage = config('commerce.pagination_per_page');

        $OrderPaymentStatus = new OrderPaymentStatus();
        $this->allPaymentStatus = $OrderPaymentStatus->getConstants();

        $this->stores = Store::where('is_primary' , 0)->get(['id','name']);
     }

    public function sortBy($field){
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }
   
    public function render()
    { 
        
        return view('livewire.transaction.index' ,[
            'transactions' => Transaction::with(['user','order'])->searchMultipleTransaction(trim(strtolower($this->search)), $this->filter)->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
}
