<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample accounts array
        $accounts = [
            [
                'name' => 'Main Account',
                'status' => 'active',
                'eni_enabled' => true,
                'account_type' => 'corporate',
                'enable_time_temp_log' => true,
                'enable_eni_facts' => true,
                'enable_cafe_cloning' => false,
                'enable_station_price' => true,
                'enable_station_note' => true,
                'enable_cust_footer_logo' => true,
                'cust_footer_logo' => 'logo_main.png',
                'access' => 'full',
            ],
            [
                'name' => 'Secondary Account',
                'status' => 'active',
                'eni_enabled' => false,
                'account_type' => 'franchise',
                'enable_time_temp_log' => false,
                'enable_eni_facts' => false,
                'enable_cafe_cloning' => true,
                'enable_station_price' => false,
                'enable_station_note' => false,
                'enable_cust_footer_logo' => false,
                'cust_footer_logo' => null,
                'access' => 'limited',
            ],
            [
                'name' => 'Test Account',
                'status' => 'inactive',
                'eni_enabled' => false,
                'account_type' => 'trial',
                'enable_time_temp_log' => false,
                'enable_eni_facts' => false,
                'enable_cafe_cloning' => false,
                'enable_station_price' => false,
                'enable_station_note' => false,
                'enable_cust_footer_logo' => false,
                'cust_footer_logo' => null,
                'access' => 'read-only',
            ],
        ];

        foreach ($accounts as $accountData) {
            Account::create($accountData);
        }
    }
}
