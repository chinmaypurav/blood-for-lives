<?php

namespace App\Services;

use App\Models\User;
use App\Models\Demand;

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
        $this->user = User::create([
            'name' => $this->validated['name'],
            'email' => $this->validated['email'],
            'password' =>bcrypt('password'),
        ]);
        //AssignRole
        $this->user->assignRole('donor'); 
        return $this;
    }

    public function createDonor()
    {
        $validated = $this->validated;
        
        $this->user->donor()->create([
            'blood_group'   => $validated['bloodGroup'],
            'contact'       => $validated['contact'],
            'postal'        => $validated['postal'],
            'dob'           => $validated['dob'],
            'donor_card_no' => 'DONOR' . $this->user->id, //Temporary set to zero.
            'lat'           => 0, //Temporary set to zero.
            'lon'           => 0, //Temporary set to zero.
        ]);
        return $this;
    }

    
}