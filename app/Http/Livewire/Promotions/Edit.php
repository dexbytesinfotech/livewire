<?php

namespace App\Http\Livewire\Promotions;

use App\Models\Promotions\Promotion;
use App\Models\Promotions\PromotionsStores; 
use App\Models\Stores\Store;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    public Promotion $promotion;
    use AuthorizesRequests;
 
   
    public $typeOptions = ['percentage' => 'Percentage','free_shipping' => 'Free Shipping'];
    public $targetOptions = ['all_order' => 'All Order', 'amount_minimum_order' => 'Order Amount for'] ;
    public $store_ids = [];
    public $never_expired;

    protected $listeners = [
        'selectedStores'
    ];
   
    protected $rules=[
        'promotion.title' => 'required|string',
        'promotion.value' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        'promotion.status' => 'nullable|between:0,1',
        'promotion.type_option' => 'required|string',
        'promotion.discount_on' => 'required|string',
        'promotion.target' => 'required|string',   
        'promotion.start_date' => 'required',
        'promotion.end_date' => 'nullable|after_or_equal:start_date|required_if:never_expired,0', 
        'promotion.is_allow_to_store' => 'nullable',
        'never_expired' => 'nullable|between:0,1',
        'promotion.min_order_price' => 'nullable|required_if:target,amount_minimum_order|numeric'
    ];

    public function mount($id) {
       // $this->stores = Store::whereStatus(1)->whereIsOpen(1)->get();   
        $this->promotion = Promotion::find($id);
        if(empty($this->promotion->end_date)){
            $this->never_expired = 1;
        }
        
        $this->promotion->start_date = Carbon::createFromFormat('Y-m-d H:i:s',$this->promotion->start_date)->format('Y-m-d H:i.');

       // $this->store_ids = PromotionsStores::where('promotion_id', $id)->pluck('store_id')->toArray();
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }  

     
    public function edit() {
        $this->validate();   
        $this->promotion->start_date = Carbon::createFromFormat('Y-m-d H:i:s',$this->promotion->start_date)->format('Y-m-d H:i.');
        if($this->never_expired){
            $this->promotion->end_date = NULL;
        }else{
            $this->promotion->end_date = Carbon::createFromFormat('Y-m-d H:i:s',$this->promotion->end_date)->format('Y-m-d H:i.');
        }
        
        $this->promotion->is_allow_to_store = $this->promotion->discount_on == 'selected_store' ? 1:0;
        $this->promotion->update();
 
        return redirect(route('promotion-management'))->with('status','Promotion successfully updated.');
    }


    public function hydrate()
    {
        $this->emit('select2StoreIds');
    }
  

    public function render()
    {
        return view('livewire.promotions.edit');
    }
}
