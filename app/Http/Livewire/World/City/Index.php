<?php

namespace App\Http\Livewire\World\City;

use App\Models\Worlds\Cities;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $city = '';
    public $filter = [];
    public $deleteId = '';
    public $cityId = '';
 
    protected $listeners = ['remove', 'confirm'];

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
        return view('livewire.world.city.index',[
            'cities' => Cities::searchMultipleCity(trim(strtolower($this->search)))->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($cityId)
    {
        $this->deleteId  = $cityId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this City!'
            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        Cities::find($this->deleteId)->delete();

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'City Delete Successfully!', 
                'text' => 'It will not list on City table soon.'
            ]);
    }

     /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($cityId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        Cities::where('id', '=' ,$cityId)->update(['status' => $status]);      

   }
}
