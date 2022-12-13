<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
                
        $this->call(CreatePermissionSeeder::class);  // Create all route permission 
        $this->call(CreateAdminPermissionsSeeder::class); // Assign all permission to admin
        $this->call(CreateProviderPermissionsSeeder::class); // Assign all permission to admin
 
    }
}
