<?php

namespace App\Http\Controllers\Bank;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Bank\RegisterRequest;

class BankRegisterController extends Controller
{
    public function create(Request $request, Bank $bank)
    {
        return view('bank.register', compact('bank'));
    }

    public function store(RegisterRequest $request, Bank $bank)
    {
        //Update Bank Details

        abort_unless($bank->status == 0, 403);

        $validated = $request->all();
        $validated['status'] = 1;

        $bank->update($validated);

        $user = $bank->user()->create([
            'name' => $bank->email,
            'password' => bcrypt($validated['password']),
            'blood_group' => $validated['blood_group'],
        ]);

        event(new Registered($user));

    }
}
