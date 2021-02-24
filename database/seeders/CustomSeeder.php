<?php

namespace Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Numbers Array
        $numbers = [
            '1' => 'one',
            '2' => 'two',
            '3' => 'three',
            '4' => 'four',
            '5' => 'five',
            '6' => 'six',
            '7' => 'seven',
            '8' => 'eight',
            '9' => 'nine',
            '10' => 'ten',
        ];

        //Roles
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $donor = Role::create(['name' => 'donor']);
        $recipient = Role::create(['name' => 'recipient']);

        //Admin
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        ]);
        $user->assignRole($admin);


        //Bank 10 entry
        for ($i=1; $i <= 10; $i++) { 
            DB::table('banks')->insert([
                'name' => 'Bank ' . $numbers[$i],
                'bank_code' => 'BB'.Str::of($i)->padLeft(3, 0),
                'manager_email' => 'man'.$numbers[$i].'@gmail.com',
                'address' => 'Address of Bank ' . $numbers[$i],
                'postal' => '401303',
                'lat' => '0',
                'lon' => '0',
            ]);
        }

        //User(Manager) for Bank 1-10
        for ($i=1; $i <= 10; $i++) { 
            
            $user = \App\Models\User::factory()->create([
                'name' => 'Manager ' . $numbers[$i],
                'email' => 'man'.$numbers[$i].'@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
                'bank_id' => $i,
            ]);

            $user->assignRole($manager);
        }

        //Donors 1 - 100
        for ($i=1; $i <= 100; $i++) { 
            DB::table('users')->insert([
                'name' => 'User ' . $i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            ]);

            DB::table('donors')->insert([
                'user_id' => $i,
                'blood_group' => Arr::random(['A+', 'A-','B+','B-','O+','O-','AB+','AB-','HH']),
                'contact' => 'eyJpdiI6IkZaSzJQT25sd1A0eGh2UHVWbkg3Z1E9PSIsInZhbHVlIjoiK0M0N1czcWNvcXhHL1Q3dkVub3AxUT09IiwibWFjIjoiMGUwODgyZmRhOTQ0YmU4ZTBhNDFjNWVhZmZlNjFhN2UwN2MxM2M4Zjg1MWRjMzhkNTZlZDFlOGRmYWNkMzA0NSJ9', 
                'dob' => '200-01-30',
                'postal' => '401303',
                'lat' => '0',
                'lon' => '0',
                'donor_card_no' => 'DONOR'.Str::of($i)->padLeft(3, 0),
            ]);
        }
    }
    
}
