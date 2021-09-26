<?php

namespace App\Services\Admin;

use App\Models\Bank;
use App\Mail\BankRegistrationMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class BankService
{
    public function index($params = [])
    {
        return Bank::paginate();
    }

    public function store(array $validated)
    {
        try {
            DB::transaction(function () use ($validated) {

                $bank = Bank::create($validated);

                // $url = URL::signedRoute('banks.register', ['bank' => $validated['bank_code']]);
                // Mail::to($bank->email)->send(new BankRegistrationMail($bank, $url));

                $user = $bank->users()->create([
                    'name' => $validated['user_name'],
                    'email' => $validated['email'],
                    'password' => bcrypt('password'),
                ]);
                $user->assignRole('manager-admin');
                $user->assignRole('manager');
            });
        } catch (\Exception $ex) {
            dd($ex);
        }


    }

    public function show(Bank $bank)
    {
        return $bank;
    }

    public function update(array $validated, Bank $bank)
    {
        //
    }
    public function destroy(Bank $bank)
    {
        $bank->delete(); // USe try catch wip
    }

}
