<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Demand;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $email = 'managerone@gmail.com';
        // $bank = Bank::factory()->create([
        //     'name' => 'Bank One',
        //     'email' => $email,
        // ]);

        // $user = User::factory()->create([
        //     'name' => 'Manager One',
        //     'email' => $email,
        // ]);

        // User::factory(10)->create();

        $demands = Donation::factory(50)->create([
            'user_id' => mt_rand(2,10),
            'bank_id' => 1,
            'bank_id' => 1,
            'status' => 'raw',
        ]);
    }
}
