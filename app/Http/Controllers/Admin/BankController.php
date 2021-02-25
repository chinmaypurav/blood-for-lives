<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\BankRequest;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::paginate(5);
        return view('admin.bank.index')->with('banks', $banks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankRequest $request)
    {
        $validated = $request->validated();

        //Create Bank Model
        $bank = Bank::create([
            'name' => $validated['bankName'],
            'bank_code' => $validated['bankCode'],
            'manager_email' => $validated['email'],
            'address' => $validated['address'],
            'postal' => $validated['postal'],
            'lat' => 0, //Temporary set to 0
            'lon' => 0, //Temporary set to 0
        ]);

        //Attach User Model
        $user = $bank->users()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password'),
        ]);
        
        //Assign Manager Role
        $user->assignRole('manager');

        return redirect()->route('admin.bank.create')->with('status', 'Bank Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
