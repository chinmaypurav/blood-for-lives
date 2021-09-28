<?php

namespace Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // RoleSeeder::class,
            // AdminSeeder::class,
            BankSeeder::class,
            // CampSeeder::class,
            // DonationSeeder::class,
            // DemandSeeder::class,
            // BankDonationSeeder::class,
        ]);
    }
}