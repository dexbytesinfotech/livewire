<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class CreatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Artisan::call('cache:forget spatie.permission.cache');
        \Artisan::call('cache:clear');
        
        $routes = Route::getRoutes()->getRoutes();
       
        foreach ($routes as $route) {  
            if ($route->getName() != '' && $route->getAction()['middleware']['0'] == 'web') {
                $permission = Permission::where('name', $route->getName())->where('guard_name', 'web')->first();
                if ($permission === null) {
                    permission::create(['name' => $route->getName()]);
                }
            }
        }


        $defaultRoutes = $this->_defaultPerission();

        foreach ($defaultRoutes as $name) {              
            $permission = Permission::where('name', $name)->where('guard_name', 'web')->first();
            if ($permission === null) {
                permission::create(['name' => $name ]);
            }             
        }
                
    }



    public function _defaultPerission(){
        return [
            'review-delete'
        ];
    }
 



}