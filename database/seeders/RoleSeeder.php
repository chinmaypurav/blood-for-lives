<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'manager-admin']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'donor']);
        Role::create(['name' => 'recipient']);
        Role::create(['name' => 'guardian']);
    }
}