<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Administrator role'],
            ['name' => 'User', 'slug' => 'user', 'description' => 'Regular user role'],
        ]);
    }
}
