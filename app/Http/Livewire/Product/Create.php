<?php

namespace App\Http\Livewire\Product;

use App\Models\Product\AddonOption;
use App\Models\Products\Product;
use App\Models\Products\ProductAddons;
use App\Models\Products\ProductCategories;
use App\Models\Products\ProductImages;
use App\Models\Stores\Store;
use App\Models\Tax\Tax;
use App\Traits\GlobalTrait;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use AuthorizesRequests;
    use WithFileUploads;
    use GlobalTrait;

    
    public $image;
    public $name = '';
    public $sku = '';
    public $tax_id = '';
    public $price = '';
    public $price_sale = '';
    public $sale_start_date = '';
    public $sale_end_date = '';
    public $product_addon_option_id = [] ;
    public $status = '';
    public $descriptions = '';
    public $categories_ids = '';
    public $is_featured = '';
    public $currentStep = 1;
    public $category = '';
    public $taxs = '';
    public $addonValue =  '' ;
    public $store_id = '';  
    public $product_store ;

    protected $listeners = [
        'getAddonOptionForInput'
    ];

   
    protected $rules = [
            'name' => 'required|string',
            'sku' => 'nullable',
            'descriptions' => 'nullable|max:1000',
            'status' => 'nullable|between:0,1',
            'categories_ids' => 'required',
            'tax_id' =>  'nullable',
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'price_sale' => 'nullable|numeric', 
            'sale_start_date' => 'nullable',
            'sale_end_date' => 'nullable',
            'product_addon_option_id' => 'nullable',
            'image' => 'mimes:jpg,jpeg,png|max:4096',

    ];

    public function mount(){
        $this->category = ProductCategories::whereStatus(1)->get();
        $this->taxs = Tax::whereStatus(1)->get();        
        
        if(auth()->user()->hasRole('Admin')){
            $this->addonValue = collect();
            $this->product_store = Store::whereStatus(1)->whereIsOpen(1)->Where('application_status', 'approved')->get();
        }else{
            $this->addonValue = AddonOption::where('store_id' , $this->getStoreId())->whereStatus(1)->orderBy('addon_type', 'ASC')->get();
        }
    }
    
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    } 

    public function updatedStoreId(){ 
        $this->addonValue = AddonOption::where('store_id' , $this->store_id)->whereStatus(1)->orderBy('addon_type', 'ASC')->get();
    } 
    
    
    public function getAddonOptionForInput($value){ 
        $this->product_addon_option_id = $value;
    }

    public function store(){
        
        if(auth()->user()->hasRole('Admin')){
            $adminValidate = $this->validate([
                'store_id' => 'required'
            ]);
            $store_id = $adminValidate['store_id'];
        }else{
            $store_id = $this->getStoreId();
        }
   
        $validated = $this->validate();
        $product = Product::create([
            'store_id' =>  $store_id,
            'name' => $this->name,
            'descriptions' => $this->descriptions,
            'status'=> $this->status ? 1:0,
            'sku' => $this->sku ? $this->sku : '',
            'categories_ids' => $this->categories_ids,
            'tax_id'    => $this->tax_id ? $this->tax_id: null,
            'is_featured' => $this->is_featured ? 1:0,
            'price'      => $this->price,
            'price_sale' => $this->price_sale ? $this->price_sale : 0,
            'sale_start_date' => $this->sale_start_date ? $this-> sale_start_date : null,
            'sale_end_date' => $this->sale_end_date ? $this->sale_end_date : null,   
       ]);
    
       if($this->product_addon_option_id){
            foreach($this->product_addon_option_id as $value){
                $addonOption[] = ['product_id'=> $product->id , 'product_addon_option_id' => $value , 'created_at' => Carbon::now() , 'updated_at' => Carbon::now()];
            }
            !empty($addonOption) ? ProductAddons::insert( $addonOption ) : "";
        }
 
        if ($this->image) {
            ProductImages::create([
                'product_id' => $product->id ,
                'image_path' =>  $this->image->store('products', config('app_settings.filesystem_disk.value')),
            ]);
        }
        
       return redirect(route('product-management'))->with('status','Product successfully created.');
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function render()
    {
        return view('livewire.product.create');
    }
}
