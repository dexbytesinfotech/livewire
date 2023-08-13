<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
class Index extends Component
{   
    public $appName = ''; 
   
    /**
    * Set initial data for the component.
    *
    */
    public function mount() 
    {
        $this->appName = config('app.name');
    }

    /**
     * render the dashboard page
     */
    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
