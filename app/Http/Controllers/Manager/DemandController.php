<?php

namespace App\Http\Controllers\Manager;

use App\Models\Donor;
use App\Models\Demand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Imports\CompatibilityController;

class DemandController extends Controller
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
        
        $demands = $bank->demands;

        
        return view('manager.demand.index')->with('demands', $demands);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.demand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $bank = $user->bank;

        $demand = $user->bank->demands();
        
        $compatibility = new CompatibilityController();
        $compatibleGroup = $compatibility->recipient($request->recipientComponent, $request->recipientGroup);


        $demand = $user->bank->demands()->create([
            'guardian_name' => $request->guardianName,
            'guardian_contact' => $request->guardianContact,
            'recipient_name' => $request->recipientName,
            'recipient_group' => $request->recipientGroup,
            'recipient_component' => $request->recipientComponent,
            'compatible_group' => $compatibleGroup,
            'buffer_time' => 2,
            'required_at' => $request->requiredAt,
            'required_units' => 2,
        ]);
        

        Demand::where('id', $demand->id)
            ->update([
            'logger->open->id' => $user->id,
            'logger->open->updated_at' => now(),
        ]);


        return redirect()->route('manager.demand.index');

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
        $user = auth()->user();
        $bank = $user->bank;

        
        $compatibleGroup = Demand::find($id)->compatible_group;

        //dd($compatibleGroup);

        $inventories = DB::table('bank_donor')
                    ->leftJoin('donors', 'donors.id', '=', 'bank_donor.donor_id')
                    ->select('bank_donor.*', 'donors.blood_group')
                    ->whereIn('donors.blood_group', $compatibleGroup)
                    //->orderBy('bank_donor.expiry_at')
                    ->get();
            
        return view('manager.demand.stock')->with([
            'inventories' => $inventories,
            'demandId' => $id,
        ]);
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
