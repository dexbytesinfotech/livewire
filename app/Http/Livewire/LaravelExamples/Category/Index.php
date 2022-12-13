<?php

namespace App\Http\Livewire\LaravelExamples\Category;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    use AuthorizesRequests;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $perPage = 10;
    
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

    public function destroy($id) {
        
        Category::find($id)->delete();
        return redirect(route('category-management'))->with('status', 'Category successfully deleted.');
    }

    public function render()
    {
        $this->authorize('manage-items', User::class);
        return view('livewire.laravel-examples.category.index',[
            'categories' => Category::searchMultiple($this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
}
