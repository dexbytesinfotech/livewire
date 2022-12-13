<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class CreateProviderPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::where('name', 'Provider')->update(['guard_name' => 'web']);
        $role = Role::where('name', 'Provider')->first();
        $permissions = Permission::whereIn('name', $this->getPermissions())->where('guard_name', 'web')->pluck('id','id')->all();
        if($permissions){
            $role->syncPermissions($permissions); 
        }
                
    }

    protected function getPermissions() {

        return [
            'dashboard',
            'register',
            'forget-password',
            'reset-password',
            'edit-profile',
            'dashboard-home',
            'product-management',
            'add-product',
            'add-category',
            'edit-product',
            'edit-category',
            'create-product-addon',
            'edit-product-addon',
            'order-details',
            'transaction-management',
            'product-category-management',
            'product-addon-management',
            'order-management',
            'provider-manage-store',
            'review-management',
            'store-promotion'
        ];
    }



}