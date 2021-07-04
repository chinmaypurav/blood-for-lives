<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\User;
use App\Mail\BankRegistrationMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

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
            'email' => $this->validated['email'],
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
        // dd($this->bank);

        $url = URL::signedRoute('bank.register', ['bank' => $validated['bank_code']]);
        Mail::to($this->bank->email)->send(new BankRegistrationMail($this->bank, $url));

        return $this;
    }
}