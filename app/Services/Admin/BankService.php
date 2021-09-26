<?php

namespace App\Services\Admin;

use App\Models\Bank;

class BankService
{
    public function index($params = [])
    {
        return Bank::paginate(5);
    }

    public function store(array $validated)
    {
        $validated = $this->validated;

        $this->bank = Bank::create($validated);
        // dd($this->bank);

        // $url = URL::signedRoute('bank.register', ['bank' => $validated['bank_code']]);
        // Mail::to($this->bank->email)->send(new BankRegistrationMail($this->bank, $url));
    }
}
