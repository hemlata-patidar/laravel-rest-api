<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountLocation;
use App\Models\Account;

class AccountLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all accounts
        $accounts = Account::all();

        foreach ($accounts as $account) {
            // Create 2 locations per account
            for ($i = 1; $i <= 2; $i++) {
                AccountLocation::create([
                    'account_id' => $account->account_id,
                    'name' => $account->name . " Location $i",
                    'status' => 'active',
                    'county' => 'County ' . $i,
                    'access' => 'full',
                    'created_date' => now(),
                    'created_by' => 1, // assuming admin user ID 1
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
