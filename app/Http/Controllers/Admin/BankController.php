<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\BloodGroup;
use Illuminate\Http\Request;
use App\Services\Admin\BankService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BankRequest;

class BankController extends Controller
{
    private $bankService;

    public function __construct(BankService $bankService)
    {
        $this->bankService = $bankService;
    }

    public function index(): View
    {
        $banks = $this->bankService->index();
        return view('admin.bank.index', compact('banks'));
    }

    public function create(): View
    {
        return view('admin.bank.create');
    }

    public function store(BankRequest $request)
    {
        $this->bankService->store($request->validated());
        return redirect()->route('admin.banks.create')->with('status', 'Bank Added!');
    }

    public function show(Bank $bank)
    {
        return view('admin.bank.show')->with('bank', $bank);
    }

    public function edit(Bank $bank)
    {
        //
    }

    public function update(Request $request, $bank)
    {
        //
    }

    public function destroy(Bank $bank)
    {
        $this->bankService->destroy($bank);
        return redirect()->route('admin.bank.index')->with('status', 'Bank Deleted!');
    }


    public function register()
    {
        $bloodGroups = BloodGroup::all();
        return view('bank.register', compact('bloodGroups'));
    }
}
