<?php

namespace App\Http\Livewire\LaravelExamples\Roles;

use Livewire\Component;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Index extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $queryString = ['sortField', 'sortDirection',];
    protected $paginationTheme = 'bootstrap';

    public function sortBy($field){
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }


    public function destroy($id){
        if (!Role::find($id)->user->isEmpty()) {
            return back()->with('error', 'This role has users attached and can\'t be deleted.');
        }
        Role::find($id)->delete();
        return redirect(route('role-management'))->with('status', 'Role successfully deleted.');
    }


    public function render()
    {
        $this->authorize('manage-users', User::class);
        
        return view('livewire.laravel-examples.roles.index', [
            'roles' => Role::searchMultiple($this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
}
