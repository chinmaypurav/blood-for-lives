<?php

namespace App\Http\Controllers\Bank;

use App\Events\Bank\BloodProcessed;
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
        // dd($manager->bank_id);
        // $donations = Donation::whereHas('banks', function ($query) use ($bank) {
        //     $query->where('banks.id', $bank->id);
        // })->paginate(5);

        // $donations = Donation::where('bank_id', $manager->bank_id)
        //     ->with('bloodComponent', 'donor.bloodGroup')
        //     ->paginate();

        $donations = Donation::where('bank_id', $user->bank_id)
            ->where('donations.status', 'raw')
            // ->with('donor.bloodGroup')
            ->paginate();

        return view('bank.process.index', ['donations' => $donations]);
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

    public function update(ProcessUpdateRequest $request, Donation $donation)
    {
        // dd($id);
        $validated = $request->validated();

        $status = $validated['action'];

        $res = $donation->update([
            'status' => $status
        ]);

        // $donation = 

        // dd($res, $status);

        if ($status == 'stored') {
            event(new BloodProcessed($donation, auth()->user()));
        }


        return redirect()->route('bank.processes.index')->with('status', 'Process successful');
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
