<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Index extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;
    protected $defaultRoles = ['Admin', 'Provider', 'Customer', 'Unverified'];
    public $deleteId = '';
    
    protected $listeners = ['remove'];
    protected $queryString = ['sortField', 'sortDirection',];
    protected $paginationTheme = 'bootstrap';
    public bool $loadData = false;
  
    public function init()
    {
         $this->loadData = true;
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
    public function destroyConfirm($roleId)
    {
        $this->deleteId  = $roleId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => __('role.Yes, delete it!'),
                'cancelButtonText' => __('role.No, cancel!'),
                'message' => __('role.Are you sure?'), 
                'text' => __('role.If deleted, you will not be able to recover this store data!')
            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        Role::find($this->deleteId)->delete();
      
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => __('role.Role Delete Successfully!')]);
    }  

    public function updatingSearch()
    {
        $this->gotoPage(1);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }   

    public function render()
    {
        return view('livewire.roles.index', [
            'roles' => $this->loadData ? Role::searchMultipleRole(trim(strtolower($this->search)))->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage) : [],
        ]);
    }
}
