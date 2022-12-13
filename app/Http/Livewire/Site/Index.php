<?php

namespace App\Http\Livewire\Site;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Route;
use Livewire\Component;
use App\Models\Config\SystemConfig;
use Livewire\WithFileUploads;

class Index extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $settings;
    public $date_format;
    public $time_format;
    public $currency;
    public $all_currency;
    public $currency_position;
    public $number_of_decimals;
    public $thousand_separator;
    public $decimal_separator;
    public $app_name;
    public $app_logo;
    public $app_logo_dark;
    public $support_number;
    public $support_email;
    public $app_api_url;
    public $app_url;    
    public $apple_store_app_url;
    public $play_store_app_url;
    public $is_updated = false;
    public $app_logo_transparent;    
    public $app_logo_trans;
    public $timezone;    
    public $default_locale;
    public $languages;
    public $timezones;
    public $app_favicon_logo;
    public $app_favicon_logo_dark;
    

    public function mount()
    {  
        $config = SystemConfig::get();
        $globleSettings = new \StdClass;
        foreach ($config as $key => $value) {
            $keys = $value->code;
            $globleSettings->$keys = $value;
        }

        $this->settings =   (array) $globleSettings;        
        $this->apple_store_app_url = $this->settings['apple_store_app_url']['value'];
        $this->play_store_app_url = $this->settings['play_store_app_url']['value'];
        $this->date_format = $this->settings['date_format']['value'];
        $this->time_format = $this->settings['time_format']['value'];
        $this->currency = $this->settings['currency']['value'];
        $this->all_currency =   \App\Dexlib\Currency::getAllCurrency();
        $this->currency_position = $this->settings['currency_position']['value'];
        $this->number_of_decimals = $this->settings['number_of_decimals']['value'];
        $this->thousand_separator = $this->settings['thousand_separator']['value'];
        $this->decimal_separator = $this->settings['decimal_separator']['value'];
        $this->app_name = $this->settings['app_name']['value'];
        $this->support_number = $this->settings['support_number']['value'];
        $this->support_email = $this->settings['support_email']['value'];        
        $this->app_api_url = $this->settings['app_api_url']['value'];        
        $this->app_url = $this->settings['app_url']['value'];
        $this->app_logo = $this->settings['app_logo']['value'];
        $this->timezone = $this->settings['timezone']['value'];
        $this->default_locale = $this->settings['default_locale']['value'];
        $this->languages = \App\Dexlib\Locale::getActiveLang();
        $this->timezones = \App\Dexlib\Timezone::getAllTimezone();
        $this->app_favicon_logo = $this->settings['app_favicon_logo']['value'];
    }


    public function updated() {
        
        $validatedData = $this->validate([
            'currency' => 'required',
            'currency_position' => 'required',
            'number_of_decimals' => 'required|numeric|min:1|max:3',
            'thousand_separator' => 'required',
            'decimal_separator' => 'required',
        ]);        
        $this->is_updated = true;
    } 



    public function updateGeneral()
    { 
        $validatedData = $this->validate([
            'app_name' => 'required|max:50|string',
            'support_number' => 'required|min:8|numeric',
            'support_email' => 'required|email',
            'app_url' => 'required|url',
            'app_api_url' => 'required|url',
            'app_logo_dark' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            'app_favicon_logo_dark' => 'nullable|mimes:jpg,jpeg,png|max:1024',            
        ]);

        SystemConfig::updateOrCreate(['code' => 'app_name'], [
                'value'     => $this->app_name
            ]
        );
        SystemConfig::updateOrCreate(['code' => 'support_email'], [
                'value'     => $this->support_email
            ]
        );
        SystemConfig::updateOrCreate(['code' => 'support_number'], [
                'value'     => $this->support_number
            ]
        );
        SystemConfig::updateOrCreate(['code' => 'app_url'], [
            'value'     => $this->app_url
            ]
        );
        SystemConfig::updateOrCreate(['code' => 'app_api_url'], [
            'value'     => $this->app_api_url
            ]
        );    

        if($this->app_logo_dark){
            $appLogo = $this->app_logo_dark->store('logo', config('app_settings.filesystem_disk.value'));
            SystemConfig::updateOrCreate(['code' => 'app_logo'], [
                'value'     => $appLogo
                ]
            );  
        }

        if($this->app_favicon_logo_dark){
            $appFaviconLogo = $this->app_favicon_logo_dark->store('logo', config('app_settings.filesystem_disk.value'));
            SystemConfig::updateOrCreate(['code' => 'app_favicon_logo'], [
                'value'     => $appFaviconLogo
                ]
            );  
        }
 
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Settings Updated Successfully!']);
    }
    

    public function updatedDateFormat()
    { 
        SystemConfig::updateOrCreate(['code' => 'date_format'],[
                'label'     => 'Date Format',
                'value'     => $this->date_format
            ]
        );
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Date Format Updated Successfully!']);
    }



    public function updatedTimeFormat()
    { 
        SystemConfig::updateOrCreate(['code' => 'time_format'],[
                'label'     => 'Time Format',
                'value'     => $this->time_format
            ]
        );

        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Time Format Updated Successfully!']);
    }

    public function updatedCurrency()
    { 
        SystemConfig::updateOrCreate(['code' => 'currency'],[
                'label'     => 'Currency',
                'value'     => $this->currency
            ]
        );
        SystemConfig::updateOrCreate(['code' => 'currency_symbol'],[
            'label'     => 'Currency Symbol',
            'value'     =>  $this->all_currency[$this->currency]['symbol']
            ]
        );

        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Currency Updated Successfully!']);
    }


    public function updatedCurrencyPosition()
    { 
        SystemConfig::updateOrCreate(['code' => 'currency_position'],[
                'label'     => 'Currency Position',
                'value'     => $this->currency_position
            ]
        );

        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Currency Position Updated Successfully!']);
    }

    public function updatedTimezone()
    { 
        SystemConfig::updateOrCreate(['code' => 'timezone'],[
                'value'     => $this->timezone
            ]
        );

        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Timezone Updated Successfully!']);
    }

    public function updatedDefaultLocale()
    { 
        SystemConfig::updateOrCreate(['code' => 'default_locale'],[
                'value'     => $this->default_locale
            ]
        );

        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Default Locale Updated Successfully!']);
    }

    public function updatedDecimalSeparator()
    { 
        SystemConfig::updateOrCreate(['code' => 'decimal_separator'],[
                'label'     => 'Decimal Separator',
                'value'     => $this->decimal_separator
            ]
        );

        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Decimal Separator Updated Successfully!']);
    }

    public function updatedThousandSeparator()
    { 
        SystemConfig::updateOrCreate(['code' => 'thousand_separator'],[
                'label'     => 'Thousand Separator',
                'value'     => $this->thousand_separator
            ]
        );

        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Thousand Separator Updated Successfully!']);
    }

    public function updatedNumberOfDecimals()
    { 
        SystemConfig::updateOrCreate(['code' => 'number_of_decimals'],[
                'label'     => 'Number Of Decimals',
                'value'     => $this->number_of_decimals
            ]
        );

        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Number Of Decimals Updated Successfully!']);
    }


    
    public function updatedAppleStoreAppUrl()
    { 
        SystemConfig::updateOrCreate(['code' => 'apple_store_app_url'],[
                'value'     => $this->apple_store_app_url
            ]
        ); 
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Apple Store App URL Updated Successfully!']);
         
    }

    public function updatedPlayStoreAppUrl()
    { 
        SystemConfig::updateOrCreate(['code' => 'play_store_app_url'],[
                'value'     => $this->play_store_app_url
            ]
        );
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'Play Store App URL Updated Successfully!']);
    }
 
    public function render()
    {
        return view('livewire.site.settings');
    }
}
