<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Posts\Post;
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
    public $pageId = '';
    protected $listeners = ['remove'];

    protected $defaultPages = ['about-us'];

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
        return view('livewire.page.index',[
            'pages' => Post::searchMultiplePage(trim(strtolower($this->search)))->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($pageId)
    {
        $this->deleteId  = $pageId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this page data!'
            ]);
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        Post::find($this->deleteId)->delete();

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Page Delete Successfully!', 
                'text' => 'It will not list on pages table soon.'
            ]);
    }  

     /**
     * update page status
     *
     * @return response()
     */
    public function statusUpdate($pageId, $status)
    {      
        $status = ( $status == "published") ? 'unpublished' : 'published';
        Post::where('id', $pageId )->update(['status' => $status]);      

   }
}
