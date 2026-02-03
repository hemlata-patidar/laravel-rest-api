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
        // Roles and Permissions
        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            RolePermissionSeeder::class,
        ]);

        // Users
        $this->call([
            UsersTableSeeder::class,
        ]);

        // Accounts, Locations, Cafes
        $this->call([
            AccountsTableSeeder::class,
            AccountLocationsTableSeeder::class,
            CafesTableSeeder::class,
        ]);
    }
}
