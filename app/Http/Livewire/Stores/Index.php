<?php

namespace App\Http\Livewire\Stores;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Stores\Store;
use App\Models\Stores\StoreType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $application_status = 'approved';
    public $filter = ["status" => null, "store_type" => null];
    public $deleteId = '';
    public $actionStatus = '';
    public $storeId = '';
    public $storeTypes;
    protected $listeners = ['remove', 'confirmApplication'];

    protected $queryString = ['sortField', 'sortDirection', 'application_status'];
    protected $paginationTheme = 'bootstrap';


    public function mount() {  
        $this->filter['application_status'] = $this->application_status;        
        $this->perPage = config('commerce.pagination_per_page');
        $this->storeTypes = StoreType::get(["id","name"]);
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
        return view('livewire.store.index',[
            'stores' => Store::where('is_primary' , 0)->searchMultipleStore(trim(strtolower($this->search)), $this->filter)->withAvg('OrderRating','rating')->withCount('OrderRating')->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
   
   
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($storeId)
    {
        $this->deleteId  = $storeId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this store data!'
            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        Store::find($this->deleteId)->delete();

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'User Delete Successfully!', 
                'text' => 'It will not list on users table soon.'
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
                'confirmButtonText' =>  $status == 'approved' ? 'Yes, approve it!' : 'Yes reject it',
                'cancelButtonText' => 'No, cancel!',
                'message' => $status == 'approved' ? 'Are you approve?' : 'Are you Reject', 
                'text' =>  $status == 'approved' ?  'If approved, store will be listed in store sections!' : 'If rejected, store will be not listed in store sections!'
            ]);
    }  

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function confirmApplication()
    {        
        Store::where('id', '=' , $this->storeId )->update(['application_status' => $this->actionStatus]);
       
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => $this->actionStatus == 'approved' ? 'Store Application Approved Successfully!' : 'Store Application Rejected ', 
            'text' => 'It will not store on users table soon.'
        ]);
    }


    
    /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($storeId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        Store::where('id', '=' , $storeId )->update(['status' => $status]);      

   }


       /**
     * update searchable status
     *
     * @return response()
     */
    public function searchableConfirm($store)
    {        
        $is_searchable = ( $store['is_searchable'] == 1 ) ? 0 : 1;
        Store::where('id', '=' , $store['id']  )->update(['is_searchable' => $is_searchable]);     

   }

    /**
     * update featured status
     *
     * @return response()
     */
    public function featuresConfirm($store)
    {  
        $is_features = ( $store['is_features'] == 1 ) ? 0 : 1;
        Store::where('id', '=' , $store['id']  )->update(['is_features' => $is_features]);      

   }

 

}
