<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Donor;
use Illuminate\Database\Seeder;

class DonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Donor::factory(500)->create();
    }
}