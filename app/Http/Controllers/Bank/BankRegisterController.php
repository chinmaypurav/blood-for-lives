<?php

namespace App\Http\Controllers\Bank;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Bank\RegisterRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::transaction(function () use (&$bank, $validated) {
                $validated['status'] = 1;
    
                $validatedBank = Arr::only($validated, []);
                $validatedUser = Arr::only($validated, ['password', 'blood_group']);
    
                $bank->update($validatedBank);
    
                $user = $bank->managers()->create([
                    'name' => $validated['admin_name'],
                    'email' => $bank->email,
                    'password' => bcrypt($validated['password']),
                    'blood_group' => $validated['blood_group'],
                ]);
                // dd($user);
                $user->assignRole('manager');
                event(new Registered($user));
            });
        } catch (\Exception $ex) {
            dd($ex);
        }
        Auth::attempt(['email'=>$bank->email, 'password' =>$request->password]);
        $request->session()->regenerate();
        return redirect(RouteServiceProvider::HOME);
    }
}
