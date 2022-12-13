<?php

namespace App\Http\Livewire\Slider;

use App\Models\Slider\Slider;
use App\Models\Slider\SliderImage;
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
    public $sliderId = '';
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
    public function destroyConfirm($sliderId)
    {
        $this->deleteId  = $sliderId;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this Slider!'
            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        Slider::find($this->deleteId)->delete();
        SliderImage::where('slider_id', $this->deleteId)->delete();
   
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Slider Delete Successfully!', 
                'text' => 'It will not list on Slider table soon.'
            ]);
    }

     /**
     * update slider status
     *
     * @return response()
     */
    public function statusUpdate($sliderId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        Slider::where('id', '=' , $sliderId )->update(['status' => $status]);      

   }

   /**
     * update slider default status
     *
     * @return response()
     */
    public function isDefaultUpdate($sliderId, $isDefault)
    {        
        $isDefault = (  $isDefault == 1 ) ? 0 : 1;
        Slider::update(['is_default' => 0]);
        Slider::where('id', '=' , $sliderId )->update(['is_default' => $isDefault]);      

   }

    public function render()
    {   
        return view('livewire.slider.index' , [
            'sliders' => Slider::searchMultipleSliders(trim(strtolower($this->search)))->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }
}
