<?php

namespace Database\Seeders;

use App\Models\BloodComponent;
use App\Models\BloodGroup;
use Illuminate\Database\Seeder;

class BloodDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BloodGroup::factory()->createMany([
            ['blood_group' => 'A+'],
            ['blood_group' => 'A-'],
            ['blood_group' => 'B+'],
            ['blood_group' => 'B-'],
            ['blood_group' => 'AB+'],
            ['blood_group' => 'AB-'],
            ['blood_group' => 'O+'],
            ['blood_group' => 'O-'],
            ['blood_group' => 'HH'],
        ]);

        BloodComponent::factory()->createMany([
            ['blood_component' => 'whole'],
            ['blood_component' => 'wbc'],
            ['blood_component' => 'rbc'],
            ['blood_component' => 'plasma'],
            ['blood_component' => 'platelets'],
        ]);
    }
}