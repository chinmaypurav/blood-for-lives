<?php

namespace App\Http\Controllers\Bank;

use App\Models\Bank;
use App\Models\Donation;
use App\Models\BankDonor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\ProcessUpdateRequest;

class ProcessController extends Controller
{
   
    public function index()
    {
        $user = auth()->user();
        $manager = $user->manager;
        // dd($manager->bank_id);
        // $donations = Donation::whereHas('banks', function ($query) use ($bank) {
        //     $query->where('banks.id', $bank->id);
        // })->paginate(5);

        // $donations = Donation::where('bank_id', $manager->bank_id)
        //     ->with('bloodComponent', 'donor.bloodGroup')
        //     ->paginate();

        $donations = Donation::where('bank_id', $manager->bank_id)
            ->where('donations.status', 'raw')
            ->join('blood_components', function ($join) {
                $join->on('donations.blood_component_id', 'blood_components.id');
            })
            ->join('donors', function ($join) {
                $join->on('donations.donor_id', 'donors.id');
            })
            ->join('blood_groups', function ($join) {
                $join->on('donors.blood_group_id', 'blood_groups.id');
            })
            ->select('donations.*', 'blood_components.*', 'donors.*', 'blood_groups.blood_group')
            // ->with('donor.bloodGroup')
            ->paginate();

        // dd($donations);
        // $donations = DB::table('bank_donor')
        //     ->leftJoin('donors', 'bank_donor.donor_id', '=', 'donors.id')
        //     ->select('bank_donor.*', 'donors.donor_card_no', 'donors.blood_group')
        //     ->where([
        //         'bank_donor.bank_id'=> $bank->id,
        //         'bank_donor.status'=> 'raw',
        //         ])
        //     ->orderBy('bank_donor.donated_at')
        //     ->paginate(10);

        return view('manager.process.index', ['donations' => $donations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.process.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

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
        return view('manager.process.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProcessUpdateRequest $request, $id)
    {
        dd($id);
        $validated = $request->validated();
        //dd($validated['action']);

        $state = $validated['action'];

        $donation = BankDonor::find($id);
        //dd($donation);

        DB::transaction(function () use (&$id, $donation, $state) {
            DB::table('bank_donor')
                ->where('id', $id)
                ->update([
                    'status' => $state,
                    'logger->' . $state . '->id' => auth()->user()->id,
                    'logger->' . $state . '->updated_at' => now(),
                ]);
        });



        return redirect()->route('manager.process.index');
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