<?php

namespace App\Http\Livewire\Product\Addon;

use App\Models\Product\AddonOption;
use App\Models\Product\AddonOptionValue;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\Features\SupportCollections;

class Edit extends Component
{

    use AuthorizesRequests;
    public AddonOption $addonOption;
    public $optionValues = [];
    public $inputTypeCode = '';
  

    protected function rules(){
        return [
            'addonOption.name' => 'required|max:255|unique:product_addon_options,name,'.$this->addonOption->id,
            'addonOption.input_type_code' => 'required|in:multichoice,singlechoice,limitedchoice',
            'addonOption.addon_type' => 'required|in:add,remove',
            'addonOption.small_descriptions' => 'required|max:100',
            'addonOption.status' => 'nullable|between:0,1',
            'addonOption.is_required' => 'nullable|between:0,1',
            'addonOption.min_select_numbers' => 'nullable|required_if:input_type_code,limitedchoice',
            'addonOption.max_select_numbers' => 'nullable|required_if:input_type_code,limitedchoice',
            'optionValues.*.option' => 'required',
            'optionValues.*.price' => 'nullable|required_if:addonType,add|numeric|min:0',
        ];  
    }

    protected $messages = [
        'optionValues.*.option.required' => 'This Name is required.',
        'optionValues.*.price.required' => 'This Price filed is required',
        'optionValues.*.price.numeric' => 'Please enter a valid price',
    ];
    
    public function mount($id) {
        $this->addonOption = AddonOption::find($id);
        $this->input_type_code =  $this->addonOption->input_type_code;
        $addonOptionValue = AddonOptionValue::where('product_addon_option_id' , $id)->get();
        foreach($addonOptionValue as $key => $value){
            $this->optionValues[] = ['option' => $value->name,'price' => $value->price];
        }
  
    }


    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }


    public function addInput()
    {    
        $this->optionValues[] = (['product_addon_option_id '=> '','option' =>'','price' => '']);
    }




    public function removeInput($index)
    {
        unset($this->optionValues[$index]);
        $this->optionValues = array_values($this->optionValues);
        
    }



    public function edit(){

        $this->validate();
        $this->addonOption->update();
        $addon = AddonOptionValue::whereProductAddonOptionId($this->addonOption->id)->delete();
        foreach($this->optionValues as $key => $value){
            $addonOptionValue[] = ['product_addon_option_id'=> $this->addonOption->id, 'name' => $value['option'], 'price' => $value['price'], 'created_at' => Carbon::now(), 'updated_at'=> Carbon::now()]; 
        }
        
        !empty($addonOptionValue) ? AddonOptionValue::insert($addonOptionValue) : "";
        return redirect(route('product-addon-management'))->with('status', 'AddonOption successfully updated.');
    }



    public function render()
    {
        return view('livewire.product.add-on-option.edit');
    }
}
