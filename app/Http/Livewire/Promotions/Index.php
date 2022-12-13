<?php

namespace App\Http\Livewire\Promotions;

use App\Models\Promotions\Promotion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = '' ;
    public $deleteId;
    public $faqId = '';
    protected $listeners = ['remove', 'confirm'];
    protected $queryString = ['sortField' , 'sortDirection'];
    protected $paginationTheme = 'bootstrap';

    public function sortBy($field){

        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }
    public function mount()
    {
         $this->perPage = config("commerce.pagination_per_page");
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($PromotionId)
    {
        $this->deleteId = $PromotionId;
       
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this Promotion!'
            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
       Promotion::find($this->deleteId)->delete();

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Promotion Delete Successfully!', 
                'text' => 'It will not list on Promotion table soon.'
            ]);
    }

     /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($PromotionId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        Promotion::where('id', '=' , $PromotionId )->update(['status' => $status]); 
   }


    public function render()
    {
        return view('livewire.promotions.index' , [
            'promotions' => Promotion::searchMultiplePromotions($this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
}
