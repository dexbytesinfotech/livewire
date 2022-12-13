<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class CreateAdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::where('name', 'Admin')->update(['guard_name' => 'web']);
        $role = Role::where('name', 'Admin')->first();
        $permissions = Permission::pluck('id','id')->all();
        if($permissions){
            $role->syncPermissions($permissions); 
        }
                
    }

}