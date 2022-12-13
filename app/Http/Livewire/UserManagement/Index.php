<?php

namespace App\Http\Livewire\UserManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Driver\UserDriver;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $account_status = '';
    public $filter = ['role' => null, 'status' => null];
    public $deleteId = '';
    public $actionStatus = '';
    public $userId = '';
    public $roles;

    protected $listeners = ['remove', 'confirmApplication'];

    protected $queryString = ['sortField', 'sortDirection', 'account_status'];
    protected $paginationTheme = 'bootstrap';


    public function mount($role = null) { 
        $this->filter['role'] = $role;
        $this->filter['account_status'] = $this->account_status;
        $this->perPage = config('commerce.pagination_per_page');
        $this->roles = Role::where('status', 1)->get(['id','name']);
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
        return view('livewire.user-management.index',[
            'users' => User::with(['roles', 'driver', 'store'])->searchMultipleUsers(trim(strtolower($this->search)), $this->filter)->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }


   /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConfirm($userId)
    {
        $this->deleteId  = $userId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this imaginary file!'
            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        User::find($this->deleteId)->delete();

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
    public function applicationConfirm($userId, $status)
    {
        $this->userId  = $userId;
        $this->actionStatus = $status;

        $this->dispatchBrowserEvent('swal:confirmApplication', [
                'action' => 'confirmApplication',
                'type' => 'warning',  
                'confirmButtonText' =>  $status == 'approved' ? 'Yes, approve it!' : 'Yes reject it',
                'cancelButtonText' => 'No, cancel!',
                'message' => $status == 'approved' ? 'Are you approve?' : 'Are you Reject', 
                'text' =>  $status == 'approved' ?  'If approved, driver will be listed in driver sections!' : 'If rejected, driver will be not listed in driver sections!'
            ]);
    }  

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function confirmApplication()
    {        
        UserDriver::where('user_id','=', $this->userId )->update(['account_status' => $this->actionStatus]);
        
        $password = 'password';
        User::where('id', '=' , $this->userId)->update(['status' => 1, 'password' => Hash::make( $password )]);

        //Twillo API
        $message = 'Your password is : '. $password;
        //Twillo::sendMessage($mobileNumber, $message);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => $this->actionStatus == 'approved' ? 'Driver Application Approved Successfully!' : 'Driver Application Rejected ', 
            'text' => 'It will not list on users table soon.'
        ]);

    }

        
    /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($userId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        User::where('id', '=' , $userId )->update(['status' => $status]);      

   }


}
