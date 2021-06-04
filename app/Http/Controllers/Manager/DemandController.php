<?php

namespace App\Http\Controllers\Manager;

use App\Models\Donor;
use App\Models\Demand;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Imports\CompatibilityController;
use App\Models\BloodComponent;
use App\Models\BloodGroup;

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
        $bank = $user->manager->bank;
        $demands = $bank->demands()->paginate();

        return view('manager.demand.index', compact('demands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bloodComponents = BloodComponent::all();
        $bloodGroups = BloodGroup::all();
        return view('manager.demand.create', compact('bloodComponents', 'bloodGroups'));
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
        // $bank = $user->bank;

        $demand = $user->bank->demands();

        $compatibility = new CompatibilityController();
        $compatibleGroup = $compatibility->recipient($request->recipientComponent, $request->recipientGroup);

        $demand = new Demand();


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
    public function edit(Demand $demand)
    {
        $user = auth()->user();
        $bank = $user->bank;
        dd($demand);


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

        $demand = Donation::find($id);

        dd($demand->logger);

        DB::transaction(function () use (&$id, $request) {
            try {
                //Demand Model
                $demand = Demand::find($id);
                $demand->status = 'allocated';
                //logger
                $demand->save();
                $state = 'stored';

                //Donation Pivot
                $donation = Donation::find($request->donation_id);
                // $donation->demand_id = $id;
                $donation->{'logger->' . $state . '->updated_at'} = now();
                $donation->save();
            } catch (\Exception $th) {
                dd($th);
            }
        });


        dd($request);
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