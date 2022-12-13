<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Order\Order;
use Illuminate\Support\Facades\DB;
use App\Traits\GlobalTrait;
class Index extends Component
{   
   use GlobalTrait;

    public $totalCustomers= 0;
    public $newCustomers= 0;
    public $totalOrders = 0;
    public $sales = 0;
    public $data = [];
    public $orders;

    public $months = [];
    public $completed = [];
    public $total = [];
    public $dateBeforeSeven;
    public $todayDate;
    public $orderStatus = ['completed', 'pending', 'cancelled', 'refund'];
    public $totalCompletedOrders = 0;
     

    public function mount() {
        
         // New customers registered in last 7 days 
        $this->dateBeforeSeven = \Carbon\Carbon::today()->subDays(7);
        $this->todayDate = \Carbon\Carbon::today();

        if(!auth()->user()->hasRole('Provider')){
            //Total customers        
            $this->totalCustomers = User::whereHas('roles', function ($query) {
                                    $query->where('name' , '=' ,  'Customer');
                                    })->count();     

            $this->newCustomers = User::whereHas('roles', function ($query){
                                $query->where('name' , '=' ,  'Customer');
                                })->where('created_at','>=', $this->dateBeforeSeven)->count();      
        }
        
        //Total orders of 7 days
        if(auth()->user()->hasRole('Provider')){
            $this->totalOrders = Order::where('store_id', $this->getStoreId())->where('created_at','>=', $this->dateBeforeSeven)->count();
            $this->totalCompletedOrders = Order::where('order_status', 'completed')->where('store_id', $this->getStoreId())->where('created_at','>=', $this->dateBeforeSeven)->count();
        }else{
            $this->totalOrders = Order::where('created_at','>=', $this->dateBeforeSeven)->count();
            $this->totalCompletedOrders = Order::where('order_status', 'completed')->where('created_at','>=', $this->dateBeforeSeven)->count();
        }
        //Total sales of 7 days           
        if(auth()->user()->hasRole('Provider')){
                $this->sales = Order::where('store_id', $this->getStoreId())->where([
                                ['created_at','>=', $this->dateBeforeSeven],
                                ['order_status', '=' ,'completed']
                                ])->sum('total_amount');
        }else{
            $this->sales = Order::where([
                    ['created_at','>=', $this->dateBeforeSeven],
                    ['order_status', '=' ,'completed']
                    ])->sum('total_amount');
        }

       
            //Total orders of 7 days	
            if(auth()->user()->hasRole('Provider')){	
                $orders = Order::where([['created_at','>=', $this->dateBeforeSeven]])
                        ->where('store_id', $this->getStoreId())
                        ->whereIn('order_status', $this->orderStatus)
                        ->select('order_status', DB::raw('count(id) as total'))
                        ->groupBy('order_status')->get();
            }else{
                $orders = Order::where([['created_at','>=', $this->dateBeforeSeven]])
                        ->whereIn('order_status',  $this->orderStatus)
                        ->select('order_status', DB::raw('count(id) as total'))
                        ->groupBy('order_status')->get();
            }
            $orderCounts = [];
            foreach($orders as $row) {
                $orderCounts[$row->order_status] = (int) $row->total;
            }
 
            $this->data['label'] = $this->orderStatus;
            foreach ($this->orderStatus as $oKey => $oValue) {
                $this->data['data'][] = (int) array_key_exists($oValue, $orderCounts) ? $orderCounts[$oValue] : 0;
            }
            
            // Total orders of 7 months
            $orderRevenues = [];
            if(auth()->user()->hasRole('Provider')){	
                // $orderRevenues = order::whereMonth("created_at",">=",  $this->dateBeforeSeven)
                //                 ->where('store_id', $this->getStoreId())
                //                 ->whereIn('order_status',['completed', 'pending', 'cancelled', 'refund'])
                //                 ->select(DB::raw('count(id) as total'), DB::raw('DATE_FORMAT(created_at, "%b") as month'), DB::raw('COUNT(case when order_status="completed" then 1 else 0  end) as completed'),DB::raw('YEAR(created_at) year, MONTH(created_at) months'))->groupby('year','months')
                //                 ->get();
            }else{
                // $orderRevenues = order::whereMonth("created_at",">=",  $this->dateBeforeSeven)
                //                 ->whereIn('order_status',['completed', 'pending', 'cancelled', 'refund'])
                //                 ->select(DB::raw('count(id) as total'), DB::raw('DATE_FORMAT(created_at, "%b") as month'), DB::raw('COUNT(case when order_status="completed" then 1 else 0  end) as completed'),DB::raw('YEAR(created_at) year, MONTH(created_at) months'))->groupby('year','months')
                //                 ->get();
            }
            
            $validateMonths = [];
            for ($i = 6; $i >= 0; $i--) {
                $month = Carbon::today()->subMonth($i);
                array_push($validateMonths,
                    $month->shortMonthName
                );
            }

			$monthData = [];
			foreach($orderRevenues as $orderRevenue) {
				$monthData[$orderRevenue['month']] = $orderRevenue;
			}
			foreach ($validateMonths as $value) {
				    $this->data['months'][] = $value;
				if(isset($monthData[$value])) {
                    $this->data['total'][] = $monthData[$value]->total;
                    $this->data['completed'][] = $monthData[$value]->completed;
				}else{
					$this->data['total'][] = 0;
					$this->data['completed'][] = 0;
				}
			}
            

    } 

    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
