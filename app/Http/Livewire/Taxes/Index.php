<?php

namespace App\Http\Livewire\Taxes;

use Livewire\Component;
use App\Models\Tax\Tax;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{   
    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $deleteId = '';
    public $taxId = '';

    protected $listeners = ['remove'];

    protected $queryString = ['sortField', 'sortDirection'];
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
        return view('livewire.taxes.index', [
            'taxes' => Tax::searchMultipleTax(trim(strtolower($this->search)))->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($taxId)
    {
        $this->deleteId = $taxId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this tax data!'
            ]);
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        Tax::find($this->deleteId)->delete();

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Tax Delete Successfully!', 
                'text' => 'It will not list on taxes table soon.'
            ]);
    }  


     /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($taxId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        Tax::where('id', '=' , $taxId )->update(['status' => $status]);      
    }

}
