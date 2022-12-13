<?php

namespace App\Http\Livewire\StoreTypes;

use Livewire\Component;
use App\Models\Stores\StoreType;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{   
    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $deleteId = '';
    public $storeTypeId = '';

    protected $listeners = ['remove'];
    protected $queryString = ['sortField', 'sortDirection',];
    protected $paginationTheme = 'bootstrap';

    public function mount() {
        $this->perPage = config('commerce.pagination_per_page');
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
        return view('livewire.store-types.index', [
            'storeTypes' => StoreType::searchMultipleStoreType(trim(strtolower($this->search)))->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($storeTypeId)
    {
        $this->deleteId  = $storeTypeId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this store type data!'
            ]);
    }

    
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        StoreType::find($this->deleteId)->delete();

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Store Type Delete Successfully!', 
                'text' => 'It will not list on store types table soon.'
            ]);
    }  


    /**
     * update store type  status
     *
     * @return response()
     */
    public function statusUpdate($storeTypeId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        StoreType::where('id', '=' , $storeTypeId )->update(['status' => $status]);      
    }
}
