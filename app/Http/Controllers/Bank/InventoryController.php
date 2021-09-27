<?php

namespace App\Http\Controllers\Bank;

use App\Models\Bank;
use App\Models\Donation;
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
        $thisBank = auth()->user()->bank;
        $banks = Bank::whereNotIn('id', [$thisBank->id])
                        ->paginate(10);

        return view('manager.inventory.index', compact('banks', 'thisBank'));
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
        // return view('debug', ['debug' => $user]);

        $inventories = Donation::select(DB::raw('count(*) as units, donations.blood_component, donors.blood_group'))
                        ->whereHas('banks', function($query) use (&$id){
                            $query->where('banks.id', $id);
                        })
                        ->where('donations.status', 'stored')
                        ->rightJoin('donors', 'donors.id', '=', 'donations.donor_id')
                        ->groupBy('blood_component', 'blood_group')
                        ->get();
        return view('manager.inventory.show', compact('inventories'));

        $inventories = Donation::select(['donations.blood_component', 'donors.blood_group'])
                        ->whereHas('banks', function($query) use (&$bank){
                            $query->where('banks.id', $bank->id);
                        })
                        ->where('donations.status', 'stored')
                        ->rightJoin('donors', 'donors.id', '=', 'donations.donor_id')
                        ->get()
                        ->groupBy(['blood_component', 'blood_group']);

        return view('manager.inventory.show', compact('inventories'));
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
