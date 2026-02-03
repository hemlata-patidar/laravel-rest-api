<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);

        $adminRole = Role::where('slug', 'admin')->first();
        $admin->roles()->attach($adminRole->role_id);
    }
}
