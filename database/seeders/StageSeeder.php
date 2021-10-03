<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('password#@007');

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@bloodforlives.org',
            'password' => $password,
        ]);
        $user->assignRole('super-admin');
        $user->assignRole('admin');


        $email = 'managerone@gmail.com';
        $bank = Bank::factory()->create([
            'name' => 'Bank One',
            'email' => $email,
        ]);

        $manager = User::factory()->create([
            'name' => 'Manager One',
            'email' => $email,
        ]);
        $manager->assignRole('manager-admin');
        $manager->assignRole('manager');
    }
}
