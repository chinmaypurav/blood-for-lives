<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank = Bank::factory()
            ->has(User::factory()->count(mt_rand(0, 5))->manager())
            ->create();

        $user = User::factory()
            ->for($bank)
            ->managerAdmin()
            ->create();
    }
}
