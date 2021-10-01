<?php

namespace App\Services\Admin;

use App\Events\Admin\BankCreated;
use App\Models\Bank;
use App\Mail\BankRegistrationMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class BankService
{
    public function index($params = [])
    {
        return Bank::latest()->paginate();
    }

    public function store(array $validated, User $admin)
    {
        try {
            DB::transaction(function () use ($validated, $admin) {

                $bank = Bank::create($validated);

                // $url = URL::signedRoute('banks.register', ['bank' => $validated['bank_code']]);
                // Mail::to($bank->email)->send(new BankRegistrationMail($bank, $url));

                event(new BankCreated($bank, $admin, $admin));
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
