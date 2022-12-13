<?php

namespace App\Http\Livewire\Ecommerce;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;
use Livewire\Component;
use App\Models\Config\SystemConfig;
 

class Settings extends Component
{
    use AuthorizesRequests;
    public $settings;
    public $restaurant_waiting_time;
    public $delivery_risk_time;
    public $delivery_distance;
    public $drivers_closest_value;
    public $drivers_receive_order_distance;
    public $delivery_cost;
    public $driver_insurance_amount;
    public $is_updated = false;
    public $driver_commission_type;
    public $driver_commission;
    public $store_commission_type;
    public $store_commission;


    public function mount()
    {  
        $config = SystemConfig::get();
        $globleSettings = new \StdClass;
        foreach ($config as $key => $value) {
            $keys = $value->code;
            $globleSettings->$keys = $value;
        }

        $this->settings =   (array) $globleSettings;
        $this->restaurant_waiting_time = $this->settings['restaurant_waiting_time']['value'];
        $this->delivery_risk_time = $this->settings['delivery_risk_time']['value'];
        $this->delivery_distance = $this->settings['delivery_distance']['value'];
        $this->drivers_closest_value = $this->settings['drivers_closest_value']['value'];
        $this->drivers_receive_order_distance = $this->settings['drivers_receive_order_distance']['value'];
        $this->delivery_cost = $this->settings['delivery_cost']['value'];
        $this->driver_insurance_amount = $this->settings['driver_insurance_amount']['value'];
        $this->driver_commission_type = $this->settings['driver_commission_type']['value'];
        $this->driver_commission = $this->settings['driver_commission']['value'];
        $this->store_commission_type = $this->settings['store_commission_type']['value'];
        $this->store_commission = $this->settings['store_commission']['value'];        
    }

    

    public function updated() {
        
        $validatedData = $this->validate([
            'delivery_cost' => 'required|gte:driver_commission|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'driver_insurance_amount' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'restaurant_waiting_time' => 'required|numeric',
            'delivery_risk_time' => 'required|numeric',
            'delivery_distance' => 'required|numeric',
            'drivers_closest_value' => 'required|numeric',
            'drivers_receive_order_distance' => 'required|numeric',
            'store_commission' => 'required|numeric|between:0,100',
            'driver_commission' => 'required|lte:delivery_cost|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);
        
        $this->is_updated = true;
    } 

    public function updatedDeliveryCost()
    {   
        SystemConfig::updateOrCreate(['code' => 'delivery_cost'],[
                'value'     => $this->delivery_cost
            ]
        ); 
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Delivery Amount Updated Successfully!']);
         
    }

    public function updatedDriverCommission()
    { 
        SystemConfig::updateOrCreate(['code' => 'driver_commission'],[
                'value'     => $this->driver_commission
            ]
        ); 
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Driver Commission Updated Successfully!']);
         
    }

    public function updatedStoreCommission()
    { 
        SystemConfig::updateOrCreate(['code' => 'store_commission'],[
                'value'     => $this->store_commission
            ]
        ); 
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Store Commission Updated Successfully!']);
         
    }


    public function updatedDriverInsuranceAmount()
    { 
        SystemConfig::updateOrCreate(['code' => 'driver_insurance_amount'],[
                'value'     => $this->driver_insurance_amount
            ]
        ); 
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Insurance Amount Updated Successfully!']);
         
    }


    public function updatedRestaurantWaitingTime()
    { 
        SystemConfig::updateOrCreate(['code' => 'restaurant_waiting_time'],[
                'value'     => $this->restaurant_waiting_time
            ]
        );
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Restaurant Waiting Time Updated Successfully!']);
    }


    public function updatedDeliveryRiskTime()
    { 
        SystemConfig::updateOrCreate(['code' => 'delivery_risk_time'],[
                'value'     => $this->delivery_risk_time
            ]
        );
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Delivery Risk Time Updated Successfully!']);
    }

    public function updatedDeliveryDistance()
    { 
        SystemConfig::updateOrCreate(['code' => 'delivery_distance'],[
                'value'     => $this->delivery_distance
            ]
        );
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Delivery Distance Updated Successfully!']);
    }

    public function updatedDriversClosestValue()
    { 
        SystemConfig::updateOrCreate(['code' => 'drivers_closest_value'],[
                'value'     => $this->drivers_closest_value
            ]
        );
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Drivers Closest Value Updated Successfully!']);
    }

    public function updatedDriversReceiveOrderDistance()
    { 
        SystemConfig::updateOrCreate(['code' => 'drivers_receive_order_distance'],[
                'value'     => $this->drivers_receive_order_distance
            ]
        );
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Drivers Receive Order Distance Updated Successfully!']);
    }
 
    public function render()
    {
        return view('livewire.ecommerce.settings');
    }
}
