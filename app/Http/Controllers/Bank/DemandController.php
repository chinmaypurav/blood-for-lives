<?php

namespace App\Http\Controllers\Bank;

use App\Models\Donor;
use App\Models\Demand;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Imports\CompatibilityController;
use App\Models\BloodComponent;
use App\Models\BloodGroup;
use App\Models\Inventory;

class DemandController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $bank = $user->bank;
        $demands = $bank->demands()->paginate();

        return view('bank.demand.index', compact('demands'));
    }

    public function create()
    {
        return view('bank.demand.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        // $bank = $user->bank;
        // dd($request->all());
        $demand = $user->bank->demands();

        $compatibility = new CompatibilityController();
        $compatibleGroup = $compatibility->recipient($request->blood_component, $request->blood_group);

        $demand = new Demand();


        $demand = $user->bank->demands()->create([
            'guardian_name' => $request->guardian_ame,
            'guardian_contact' => $request->guardian_contact,
            'recipient_name' => $request->recipient_name,
            'blood_group' => $request->blood_group,
            'blood_component' => $request->blood_component,
            'compatible_groups' => $compatibleGroup,
            'buffer_days' => 2,
            'required_at' => $request->required_at,
            'required_units' => 2,
        ]);


        return redirect()->route('bank.demands.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Demand $demand)
    {
        $user = auth()->user();
        $bank = $user->bank;

        // dd($demand->toArray());

        $compatibleGroups = $demand->compatible_groups;

        // dd($compatibleGroups);

        $inventories = Inventory::query()
            ->whereIn('blood_group', $compatibleGroups)
            ->get();

        // $inventories = DB::table('bank_donor')
        //     ->leftJoin('donors', 'donors.id', '=', 'bank_donor.donor_id')
        //     ->select('bank_donor.*', 'donors.blood_group')
        //     ->whereIn('donors.blood_group', $compatibleGroups)
        //     //->orderBy('bank_donor.expiry_at')
        //     ->get();

        // dd($inventories);

        return view('bank.demand.stock')->with([
            'inventories' => $inventories,
            'demandId' => $demand->id,
        ]);
    }

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

    public function destroy($id)
    {
        //
    }
}
