<?php

namespace App\Http\Livewire\Slider;

use App\Models\Slider\Slider;
use App\Models\Slider\SliderImage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Edit extends Component
{
    public Slider $slider;
    public SliderImage $sliderImages;
    public $image;
    public $sliderImage = [];
    public $deleteId;
    public $sliderId = '';
    protected $listeners = ['remove', 'confirm'];
     
    use AuthorizesRequests;  
    use WithFileUploads;


    protected function rules(){

        return [
            'slider.name' => 'required|string',
            'slider.description' => 'required|max:1000',
            'slider.status' => 'nullable|between:0,1',
            'slider.is_default' => 'nullable|between:0,1',    
            'slider.start_date_time' => 'required',
            'slider.end_date_time'   => 'required',
        ];
         
    }
 
    public function mount($id){
        $this->slider = Slider::find($id);
        $this->sliderImage = $this->slider->sliderImage;
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
 

    public function edit() {
        $this->validate();
        if($this->slider->is_default){
            Slider::where('is_default', 1)->update(['is_default' => 0]);
        }
        $this->slider->update();

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Slider successfully updated.']);  
    }

    private function resetInputFields(){
        $this->image = '';
    }
 
    public function storeImage(){
        $validatedData = $this->validate([
            'image' => 'mimes:jpeg,jpg,png|required|max:1024',
        ],
        [
            'image.required' => 'The Image cannot be empty.',
            
        ]);

        $validatedData[ 'slider_id'] = $this->slider->id ; 
        $validatedData[ 'image'] = $this->image->store('sliderImage', config('app_settings.filesystem_disk.value'));
        $validatedData[ 'status'] =  0;
        SliderImage::create($validatedData);       
      
        $this->image = '';
        $this->emit('sliderImage');

        $this->slider = Slider::find( $this->slider->id);
        $this->sliderImage = $this->slider->sliderImage;

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Slider Image successfully uploaded.']);
        
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
                'text' => 'If deleted, you will not be able to recover this Slider Image!'
            ]);
           
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {       
        SliderImage::find($this->deleteId)->delete();        
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Slider Image Delete Successfully!', 
                'text' => 'It will not list on Slider Image table soon.'
            ]);
           
            
        $this->slider = Slider::find( $this->slider->id);
        $this->sliderImage = $this->slider->sliderImage;

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Slider Image successfully deleted.']);
            
    }

     /**
     * update store status
     *
     * @return response()
     */
    public function statusUpdate($sliderId, $status)
    {        
        $status = ( $status == 1 ) ? 0 : 1;
        SliderImage::where('id', '=' , $sliderId )->update(['status' => $status]);      

   }

    public function render()
    {
        return view('livewire.slider.edit' );
    }
}
