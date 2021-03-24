<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Donor;
use Illuminate\Database\Seeder;

class DonorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $donors = Donor::factory(500)->create();
    }
}
