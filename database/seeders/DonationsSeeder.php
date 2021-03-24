<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Donation;
use Illuminate\Database\Seeder;

class DonationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Donation::factory(1000)->create();
    }
}
