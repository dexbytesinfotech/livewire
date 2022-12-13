<?php

namespace App\Http\Livewire\Tags;

use App\Models\Tags\Tag;
use Livewire\Component;
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
    }

    public function render()
    {
       return view('livewire.tags.index', [
          'tags' => Tag::searchMultipleTag(trim(strtolower($this->search)))->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
       ]);

    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        Tag::find($this->deleteId)->delete();
        
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Tag Delete Successfully!', 
                'text' => 'It will not list on tags table soon.'
            ]);
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
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this tag data!'
            ]);
    }

    
     /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($tagId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        Tag::where('id', '=' ,$tagId )->update(['status' => $status]);      

   }

}
