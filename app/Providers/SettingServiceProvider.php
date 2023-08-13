<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Factory;
use App\Models\Config\SystemConfig;
use Illuminate\Support\Facades\Schema;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Factory $cache, SystemConfig $settings)
    {
        if(Schema::hasTable('system_config')) {
            
            // 1 day  = 1440 Min
            // 1 Hours = 60 Min
            
          //  $settings = $cache->remember('app_settings', 60, function() use ($settings){           
            $config = $settings->get();
            $globle = new \StdClass;
            
            foreach ($config as $key => $value) {
                $keys = $value->code;
                $globle->$keys = $value;
            }
            $settings = (array) $globle;
            
           // return (array) $globle;
            //});
    
           if(!empty($settings)){
                config()->set('app_settings', $settings);
            }          
    
            ///TIMEZONE UPDATE
            if (array_key_exists("timezone", $settings) && !empty($settings['timezone']['value'])){ 
                config()->set('app.timezone', $settings['timezone']['value']);
                date_default_timezone_set($settings['timezone']['value']);
            }

        }else{
            config()->set('app_settings', []);
        }
         
    }
}