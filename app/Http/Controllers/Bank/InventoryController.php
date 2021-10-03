<?php

namespace App\Http\Controllers\Bank;

use App\Models\Bank;
use App\Models\Donation;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Bank\InventoryService;

class InventoryController extends Controller
{
    private $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function index(Bank $bank, Request $request)
    {
        $inventories = $this->inventoryService->index($bank, $request->all());

        return view('bank.inventory.index', compact('inventories', 'bank'));
    }

    public function create(Bank $bank)
    {
        //
    }

    public function store(Request $request, Bank $bank)
    {
        //
    }

    public function show(Bank $bank, Request $request)
    {
        $user = auth()->user();
        $bank = $user->bank;
        // return view('debug', ['debug' => $user]);

        // $inventories = Donation::select(DB::raw('count(*) as units, donations.blood_component, donors.blood_group'))
        //     ->whereHas('banks', function ($query) use (&$id) {
        //         $query->where('banks.id', $id);
        //     })
        //     ->where('donations.status', 'stored')
        //     ->rightJoin('donors', 'donors.id', '=', 'donations.donor_id')
        //     ->groupBy('blood_component', 'blood_group')
        //     ->get();
        // dd($request->all());
        $inventories = $bank->inventories()->select(DB::raw('SUM(units) as units, blood_component, blood_group'))
            ->groupBy('blood_component', 'blood_group')
            ->when($request->filled('blood_group'), function ($q, $param) {
                $q->having('blood_group', $param);
            })
            ->when($request->filled('blood_component'), function ($q, $param) {
                $q->having('blood_component', $param);
            })
            ->get();
        // dd($inventories);
        return view('bank.inventory.show', compact('inventories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Bank $bank)
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
    public function update(Request $request, $id, Bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Bank $bank)
    {
        //
    }
}
