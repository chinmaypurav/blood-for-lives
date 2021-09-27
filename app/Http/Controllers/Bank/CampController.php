<?php

namespace App\Http\Controllers\Bank;

use App\Models\Camp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\CampRequest;
use App\Services\Bank\CampService;

class CampController extends Controller
{
    private $campService;

    public function __construct(CampService $campService)
    {
        $this->campService = $campService;
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            $this->bank = $this->user->bank;

            return $next($request);
        });
    }

    public function index()
    {
        $camps = $this->campService->index(auth()->user()->bank);
        return view('bank.camp.index', compact('camps'));
    }

    public function create()
    {
        return view('bank.camp.create');
    }


    public function store(CampRequest $request)
    {
        $camps = $this->campService->store(auth()->user()->bank, $request->validated());

        return redirect()->route('bank.camps.index')->with('status', 'Camp Added Successfully');
    }

    public function show(Camp $camp)
    {
        $camp = $this->campService->show($camp);
        return view('bank.camp.show', compact('camp'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
