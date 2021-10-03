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
        $bank = Bank::create([
            'name' => 'Bank One',
            'email' => $email,
            'bank_code' => 'BB001',
            'address' => 'address of bank one',
            'postal' => '400001',
            'is_verified' => true,
            'is_active' => true,
        ]);

        $manager = User::create([
            'name' => 'Manager One',
            'email' => $email,
            'password' => $password,
        ]);
        $manager->assignRole('manager-admin');
        $manager->assignRole('manager');
    }
}
