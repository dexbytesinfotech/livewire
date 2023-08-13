<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class CreateAgentPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::where('name', 'Agent')->update(['guard_name' => 'web']);
        $role = Role::where('name', 'Agent')->first();
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
        ];
    }



}