<?php

namespace Database\Seeders;

use App\Models\Demand;
use Illuminate\Database\Seeder;

class DemandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Recipient Seed
        Demand::factory(100)->create();
    }
}
