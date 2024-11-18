<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(CreatePermissionSeeder::class);  // Create all route permission
        $this->call(CreateAdminPermissionsSeeder::class); // Assign all permission to admin
        $this->call(CreateAgentPermissionsSeeder::class); // Assign all permission to Agent

    }
}
