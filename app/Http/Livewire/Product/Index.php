<?php

namespace App\Http\Livewire\Product;

use App\Models\Products\Product;
use App\Models\Products\ProductCategories;
use App\Models\Products\ProductImages;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\GlobalTrait;

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
    public $filter = [];
    public $CheckedProduct = [];
    public $deleteID='';
    public $productId = '';
    public $destroyMultiple =  [];
    public $deleteIDs =  [];
    public $productImage ;

    protected $listeners = ['remove', 'confirm','deleteCheckedProduct','removeMultiple'];

    protected $queryString = ['sortField', 'sortDirection',];
    protected $paginationTheme = 'bootstrap';
    
 
    public function mount() {
        $this->perPage = config('app_settings.pagination_per_page.value');
        
        if(auth()->user()->hasRole('Provider')){
            $this->filter['is_provider'] = true;
            $this->filter['store_id'] = $this->getStoreId();
        }
        
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
        Product::find($this->deleteId)->delete();

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Product Delete Successfully!', 
                'text' => 'It will not list on product table soon.'
            ]);
    }
    
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyMultiple()
    {
        ;
        $this->dispatchBrowserEvent('swal:destroyMultiple', [
                'action' => 'deleteCheckedProduct',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this products!',
            ]);
    }   

/**
     * Write code on Method
     *
     * @return response()
     */
    public function deleteCheckedProduct( )
    {
        Product::whereKey( $this->destroyMultiple )->delete();
        $this->destroyMultiple = [];
          $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'products Delete Successfully!', 
                'text' => 'It will not list on product table soon.'
            ]);
    }
    

    public function render()
    {
        return view('livewire.product.index',[
            'products' => Product::with(['productCategories', 'Productstore', 'image'])->searchMultipleProduct(trim(strtolower($this->search)), $this->filter)->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
            
    /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($productId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        Product::where('id', '=' , $productId )->update(['status' => $status]);      

   }

}
