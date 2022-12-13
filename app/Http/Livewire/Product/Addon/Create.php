<?php

namespace App\Http\Livewire\Product\Addon;

use App\Models\Product\AddonOption;
use App\Models\Product\AddonOptionValue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection as SupportCollection;
use Livewire\Component;
use App\Traits\GlobalTrait;

class Create extends Component
{
    use AuthorizesRequests;  
    use GlobalTrait;

    public $name = '';
    public $smallDescription = '';
    public $inputTypeCode = '';
    public $addonType = 'add';
    public $isRequired = '';
    public $status = '';
    public $minSelectNumbers = '';
    public $maxSelectNumbers = '';
    public $price ='';
    public $option = '';
    public $optionValueId = '';
    public $productAddonOptionId = '';
    public SupportCollection $optionValues;


    protected $rules = [
        'name' => 'required|max:255|unique:product_addon_options,name',
        'inputTypeCode' => 'required|in:multichoice,singlechoice,limitedchoice',
        'addonType' => 'required|in:add,remove',
        'smallDescription' => 'required|max:100',
        'status' => 'nullable|between:0,1',
        'isRequired' => 'nullable|between:0,1',
        'minSelectNumbers' => 'nullable|required_if:inputTypeCode,limitedchoice',
        'maxSelectNumbers' => 'nullable|required_if:inputTypeCode,limitedchoice',
        'optionValues.*.option' => 'required',
        'optionValues.*.price' => 'nullable|required_if:addonType,add|numeric|min:0',
    ];
    protected $messages = [
        'optionValues.*.option.required' => 'This Name is required.',
        'optionValues.*.price.required' => 'This Price filed is required|required_if:addonType,add',
        'optionValues.*.price.numeric' => 'Please enter a valid price',
    ];
    
    public function addInput()
    {    
    $this->optionValues->push(['product_addon_option_id '=> '','option' => '','price' => '']);
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    } 

    public function removeInput($key)
    {
    $this->optionValues->pull($key);
    
    }

public function mount()
    {
    $this->fill([
        'optionValues' => collect([['product_addon_option_id '=> '', 'option' => '','price' => '']]),
    ]);
    }

    public function store(){
        $this->validate();
        $addons = AddonOption::create([
            'store_id' => $this->getStoreId(),
            'name'         => $this->name,
            'input_type_code'  => $this->inputTypeCode,
            'addon_type' => $this->addonType,
            'small_descriptions' => $this->smallDescription,
            'status'        => $this->status ? 1:0,
            'is_required'  => $this->isRequired ? 1:0,
            'min_select_numbers'     => !empty($this->minSelectNumbers) ? $this->minSelectNumbers : 0,
            'max_select_numbers'  => !empty($this->maxSelectNumbers) ? $this->maxSelectNumbers : 0,
        ]);
       
        foreach($this->optionValues as $key => $value){
            $addonOptionValue[] = ['product_addon_option_id'=> $addons->id, 'name' => $value['option'], 'price' => $value['price'], 'created_at' => Carbon::now(), 'updated_at'=> Carbon::now()]; 
        }
        AddonOptionValue::insert($addonOptionValue);
    
        return redirect(route('product-addon-management'))->with('status','AddonOption successfully created.');
    }


    public function render()
    {
        return view('livewire.product.add-on-option.create');
    }

}

