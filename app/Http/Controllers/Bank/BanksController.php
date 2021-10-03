<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BanksController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        
        $banks = Bank::whereNotIn('id', [$user->bank_id])->paginate();

        return view('banks.index', compact('banks'));
    }

    public function show(Bank $bank)
    {
        //
    }
}
