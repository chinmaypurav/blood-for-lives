<?php

namespace App\Http\Controllers\Manager;

use App\Models\Bank;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $bank = $user->bank;

        $banks = Bank::paginate(10);

        return view('manager.inventory.index')->with('banks', $banks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $bank = Bank::findOrFail($id);

        $inventories = DB::table('bank_donor')
            ->leftJoin('donors', 'bank_donor.donor_id', '=', 'donors.id')
            ->select(
                DB::raw('count(*) as unit_count, bank_donor.blood_component, donors.blood_group')
                )
            ->where([
                'bank_donor.bank_id'=> $bank->id,
                'bank_donor.status'=> 'stored',
                ])
            ->groupBy('bank_donor.blood_component', 'donors.blood_group')
            ->get();

        return view('manager.inventory.show')->with('inventories', $inventories);
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
