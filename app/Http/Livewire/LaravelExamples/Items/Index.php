<?php

namespace App\Http\Livewire\LaravelExamples\Items;

use App\Models\Faq\Faq;
use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;

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


    public function destroy($id){

       // $currentPicture = Faq::find($id);


        Faq::find($id)->delete();

        return redirect(route('item-management'))->with('status','Item successfully deleted.');
    }

    public function render()
    {
        return view('livewire.laravel-examples.items.index',[
            'items' => Item::searchMultipleItems($this->search)
                    ->join('item_tag', 'id', '=', 'item_tag.item_id')
                    ->join('tags', 'tags.id', '=', 'item_tag.tag_id')
                    ->groupBy('items.id')
                    ->orderBy($this->sortField, $this->sortDirection)
                    ->select('items.*', DB::raw('GROUP_CONCAT(tags.id) as TagsName'))
                    ->paginate($this->perPage),
        ]);
    }
}
