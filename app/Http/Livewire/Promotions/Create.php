<?php

namespace App\Http\Livewire\Promotions;

use App\Models\Promotions\Promotion;
use App\Models\Promotions\PromotionsStores; 
use App\Models\Stores\Store;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Create extends Component
{

    use AuthorizesRequests;
    public $value = '';
    public $title = ''; 
    public $status = '';
    public $typeOptions = ['percentage' => 'Percentage','free_shipping' => 'Free Shipping'];
    public $target ;
    public $targetOptions = ['all_order' => 'All Order', 'amount_minimum_order' => 'Order Amount for'] ;
    public $start_date ;
    public $end_date ;
    public $allow_participant;
    public $type_option;
    public $stores;
    public $never_expired;
    public $min_order_price;
    public $store_ids = [];
    public $discount_on = 'all_store';

    protected $listeners = [
        'selectedStores'
    ];
   
    protected $rules=[
        'title' => 'required|string',
        'value' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        'status' => 'nullable|between:0,1',
        'type_option' => 'required|string',
        'discount_on' => 'required|string',
        'target' => 'required|string',   
        'start_date' => 'required|date_format:Y-m-d H:i',
        'end_date' => 'nullable|date_format:Y-m-d H:i|after_or_equal:start_date|required_if:never_expired,0', 
        'allow_participant' => 'nullable',
        'never_expired' => 'nullable|between:0,1',
        'store_ids' => 'nullable',
        'min_order_price' => 'nullable|required_if:target,amount_minimum_order|numeric'
    ];

    public function mount() {
       // $this->stores = Store::whereStatus(1)->whereIsOpen(1)->get();   
        $this->allow_participant = 1; 
        $this->never_expired = 1;  
        $this->status = 1;    
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }  

     
    public function store() {
        $this->validate(); 
        
        if($this->never_expired){
            $this->end_date = NULL;
        }
 
        $promotion = Promotion::create([
            'title'  => $this->title,
            'value'  => $this->value,
            'status' => $this->status ? 1 : 0,
            'type_option' => $this->type_option,
            'target'     => $this->target,
            'start_date' => $this->start_date ? $this->start_date:null,
            'end_date'  => $this->end_date ? $this->end_date:null,
            'is_allow_to_store' => $this->discount_on == 'selected_store' ? 1:0,
            'min_order_price' => $this->min_order_price,
            'min_order_price' => $this->min_order_price,
            'discount_on' => $this->discount_on
        ]);

        // $storeIds = [];
        // foreach( $this->store_ids as $store_id ){     
        //     $storeIds[] = [ 'promotion_id' => $promotion->id, 'store_id' => $store_id, 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() ] ;
        // }
        // !empty($storeIds) ? PromotionsStores::insert($storeIds) : "";
 
        return redirect(route('promotion-management'))->with('status','Promotion successfully created.');
    }


    public function hydrate()
    {
        $this->emit('select2');
    }
    
    public function selectedStores($value) {   
        $this->store_ids = $value; 
    }


    public function updatedTypeOption(){
        if($this->type_option == 'free_shipping'){
            $this->value = config('app_settings.driver_commission.value');
        }else{
            $this->value = '';
        }

    }
 


    public function render()
    {
        return view('livewire.promotions.create');
    }
}
