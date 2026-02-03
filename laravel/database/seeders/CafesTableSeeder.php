<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cafe;
use App\Models\Account;
use App\Models\AccountLocation;

class CafesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all accounts
        $accounts = Account::all();

        foreach ($accounts as $account) {
            // Get all locations of this account
            $locations = AccountLocation::where('account_id', $account->account_id)->get();

            foreach ($locations as $location) {
                // Create 2 cafes per location
                for ($i = 1; $i <= 2; $i++) {
                    Cafe::create([
                        'account_id' => $account->account_id,
                        'location_id' => $location->location_id,
                        'name' => $location->name . " Cafe $i",
                        'status' => 'active',
                        'menu_type' => 'coffee',
                        'position' => $i,
                        'is_default' => $i === 1, // first cafe is default
                        'cost_center' => 'CC' . $i,
                        'enable_station_price' => true,
                        'enable_station_note' => true,
                        'enable_cust_footer_logo' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
