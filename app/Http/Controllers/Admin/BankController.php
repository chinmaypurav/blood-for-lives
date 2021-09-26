<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\BloodGroup;
use Illuminate\Http\Request;
use App\Services\Admin\BankService;
use App\Services\BankCreateService;
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
        $banks = $this->bankService->store($request->validated());


        $bankService = new BankCreateService($request->validated());
        $bankService->createBank();

        return redirect()->route('admin.banks.create')->with('status', 'Bank Added!');
    }

    public function show(Bank $bank)
    {
        return view('admin.banks.show')->with('bank', $bank);
    }

    public function edit($id)
    {
        //
    }

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
