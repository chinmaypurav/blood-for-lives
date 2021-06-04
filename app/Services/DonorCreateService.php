<?php

namespace App\Services;

use App\Models\User;
use App\Models\Demand;
use Illuminate\Support\Facades\DB;

class DonorCreateService
{
    private $validated;
    private $user;

    public function __construct($validated)
    {
        $this->validated = $validated;
    }

    public function createUser()
    {
    }

    public function createDonor()
    {
        $validated = $this->validated;

        return $this;
    }

    public function create()
    {

        DB::transaction(function () {
            try {
                $user = User::create([
                    'name' => $this->validated['name'],
                    'email' => $this->validated['email'],
                    'password' => bcrypt('password'),
                ]);
                //AssignRole
                $user->assignRole('donor');

                $user->donor()->create([
                    'blood_group_id'    => $this->validated['blood_group'],
                    'contact'           => $this->validated['contact'],
                    'postal'            => $this->validated['postal'],
                    'date_of_birth'     => $this->validated['date_of_birth'],
                    'donor_card_no'     => 'DONOR' . $this->user->id, //Temporary set to zero.
                    'lat'               => 0, //Temporary set to zero.
                    'lon'               => 0, //Temporary set to zero.
                ]);
            } catch (\Exception $e) {
                //throw $th;
            }
        });

        return $this;
    }
}