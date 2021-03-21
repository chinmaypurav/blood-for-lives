<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\User;

class BankCreateService
{
    private $validated;
    private $bank;

    public function __construct($validated)
    {
        $this->validated = $validated;
    }

    public function createUser()
    {
        //Attach User Model
        $user = $this->bank->users()->create([
            'name' => $this->validated['user_name'],
            'email' => $this->validated['manager_email'],
            'password' => bcrypt('password'),
        ]);
        
        //Assign Manager Role
        $user->assignRole('manager');
       
        return $this;
    }

    public function createBank()
    {
        $validated = $this->validated;
        
        $this->bank = Bank::create($validated);
        
        return $this;
    }

    
}