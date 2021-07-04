<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\BankRegistrationMail;
use App\Services\BankCreateService;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\BankRequest;
use App\Models\BloodGroup;

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



        $bankService = new BankCreateService($validated);
        $bankService->createBank();

        return redirect()->route('admin.banks.create')->with('status', 'Bank Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return view('admin.bank.show')->with('bank', $bank);
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

    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('admin.banks.index')->with('status', 'Bank Deleted!');
    }


    public function register()
    {
        $bloodGroups = BloodGroup::all();
        return view('bank.register', compact('bloodGroups'));
    }
}