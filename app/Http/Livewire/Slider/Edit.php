<?php

namespace App\Http\Livewire\Slider;

use App\Models\Slider\Slider;
use App\Models\Slider\SliderImage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
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
    protected $listeners = ['remove', 'confirm', 'refreshComponent' => '$refresh'];
     
    use AuthorizesRequests;  
    use WithFileUploads;


    protected function rules(){

        return [
            'slider.name' => 'required|string',
            'slider.description' => 'required|max:1000',
            'slider.status' => 'nullable|between:0,1',
            'slider.is_default' => 'nullable|between:0,1',    
            'slider.start_date_time' => 'required',
            'slider.end_date_time' => 'required',
        ];
         
    }
 
    public function mount($id){
        //  Faq translate
        $this->lang = request()->ref_lang;
        $this->languages = request()->language;
        
        $this->slider = Slider::find($id);
      
        $this->slider->name = isset($this->slider->translate($this->lang)->name) ?  $this->slider->translate($this->lang)->name: $this->slider->translate(config('app.locale'))->name;
        $this->slider->description = isset($this->slider->translate($this->lang)->description) ? $this->slider->translate($this->lang)->description : $this->slider->translate(config('app.locale'))->description;
       //  Faq translate

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
        ['type' => 'success',  'message' => __('slider.Slider successfully updated.')]);  
    }

    public function resetInputFields() {
        $this->image = '';
    }

    public function updatedImage() {
        $validator = Validator::make(
            ['image' => $this->image],
            ['image' => 'mimes:jpg,jpeg,png|required|max:4096'],
        );

        if ($validator->fails()) {
            $this->reset('image');
            $this->setErrorBag($validator->getMessageBag());
            return redirect()->back();
        }

        
    }
 
    public function storeImage(){
        $validatedData = $this->validate([
            'image' => 'required',
        ],
        [
            'image.required' => __('slider.The Image cannot be empty.'),
            
        ]);

        $sliderImage = Image::make($this->image->getRealPath());
        $sliderImageName  = time() . '.' . $this->image->getClientOriginalExtension();
        Storage::disk(config('app_settings.filesystem_disk.value'))->put('sliders/original/'.$sliderImageName, (string) $sliderImage->encode());
        
        $sliderImage->resize(728, null, function ($constraint) {
            $constraint->aspectRatio();  
            $constraint->upsize();               
        });

        Storage::disk(config('app_settings.filesystem_disk.value'))->put('sliders/thumbnails'.'/'.$sliderImageName, $sliderImage->stream());
        $sliderImagePath = 'sliders/thumbnails'.'/'.$sliderImageName;

        $validatedData['slider_id'] = $this->slider->id ; 
        $validatedData['image'] = $sliderImagePath;
        $validatedData['status'] =  0;
        SliderImage::create($validatedData);       
      
        $this->image = '';
        $this->emit('sliderImage');

        $this->slider = Slider::find($this->slider->id);
        $this->sliderImage = $this->slider->sliderImage;

        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('slider.Slider Image successfully uploaded.')]);
        
        $this->dispatchBrowserEvent('closeModal');

        $this->emit('refreshComponent');
       
        //return redirect(request()->header('Referer'));
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
                'confirmButtonText' => __('slider.Yes, delete it!'),
                'cancelButtonText' => __('slider.No, cancel!'),
                'message' => __('slider.Are you sure?'), 
                'text' => __('slider.If deleted, you will not be able to recover this Slider Image!')
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
        $this->slider = Slider::find( $this->slider->id);
        $this->sliderImage = $this->slider->sliderImage;
         
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => __('slider.Slider Image successfully deleted.')]);
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

    public function editTranslate()
    {
        $request =  $this->validate([
            'slider.name' => 'required|string',
            'slider.description' => 'required|max:1000',
        ]);

        $data = [
            $this->lang => $request['slider']
        ];

        $slider = Slider::findOrFail($this->slider->id);
        $slider->update($data);
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Slider successfully updated.']);
       
    }


    public function render()
    {
        if ($this->lang != app()->getLocale()) {
            return view('livewire.slider.edit-language');
        }
        return view('livewire.slider.edit');
    }
}
