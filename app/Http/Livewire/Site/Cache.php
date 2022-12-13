<?php

namespace App\Http\Livewire\Site;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;
use Livewire\Component; 
use Illuminate\Support\Facades\Http;


class Cache extends Component
{
    use AuthorizesRequests;
   

    public function cacheClear()
    { 
        \Artisan::call('cache:clear');
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Clear cache Successfully!']);
    }

    public function configClear()
    { 
        \Artisan::call('config:clear');
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Config cache clear Successfully!']);
    }

    public function routeClear()
    { 
        \Artisan::call('route:clear');
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Route cache clear Successfully!']);
    }
 
    public function mobileCacheClear()
    { 
       
        $endpoint = config('app_settings.app_api_url.value'); 
        if($endpoint){
            $response = Http::get($endpoint.'/system/cache/cache:clear'); 
          
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'API cache clear Successfully!']);

        }else{
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'error',  'message' => 'API end point not exits!']);
        }
       
        
    }
    
 
    public function render()
    {
        return view('livewire.site.cache');
    }
}
