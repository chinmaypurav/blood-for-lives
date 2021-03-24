<?php

namespace Database\Seeders;

use App\Models\BankDonation;
use Illuminate\Database\Seeder;

class BankDonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankDonation::factory(200)->create();
    }
}
