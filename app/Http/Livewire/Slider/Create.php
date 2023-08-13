<?php

namespace App\Http\Livewire\Slider;

use App\Models\Slider\Slider;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{

    use AuthorizesRequests;
    
    public $name ='';
    public $description ='';
    public $status = 0;
    public $is_default = 0;
    public $start_date_time = '';
    public $end_date_time = '';

    protected $rules=[
        'name' => 'required|string',
        'description' => 'nullable|max:1000',
        'status' => 'nullable|between:0,1',
        'is_default' => 'nullable',    
        'start_date_time' => 'required',
        'end_date_time'   => 'required|after:start_date_time'
    ];

    public function updated($propertyName){

        $this->validateOnly($propertyName);

    } 
 
    public function saveForm()
    {
        $description = $this->description;
            if ($description == '<p>b</p>'){
                $this->$description = __('slider.cannot send empty value');
            }
        $this->validate();
        
    }

    public function store(){
      
        $this->validate();

        $faq = Slider::create([
            'name'         => $this->name,
            'description'  => $this->description,
            'status'       => $this->status ? 1 : 0,
            'is_default'   => $this->is_default ? 1 : 0,
            'start_date_time'   => $this->start_date_time,
            'end_date_time' => $this->end_date_time,
        ]);

 
        return redirect(route('slider-management'))->with('status', __('slider.Slider successfully created.'));
    }


    public function render()
    {
        return view('livewire.slider.create');
    }
}
