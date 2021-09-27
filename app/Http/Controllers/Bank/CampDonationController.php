<?php

namespace App\Http\Controllers\Bank;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DonorSearchService;
use App\Http\Requests\Manager\DonationSearchRequest;
use App\Models\Camp;

class CampDonationController extends Controller
{
    public function index(Camp $camp)
    {
        //search bardd
        return view('bank.camp.donation.index', compact('camp'));
    }

    public function create(Camp $camp)
    {
        //create form
    }

    public function store(DonationSearchRequest $request, Camp $camp)
    {
        $validated = $request->validated();
        $donor = DonorSearchService::run($validated);

        if (!$donor) {
            return back()->with('status', 'Invalid donor details');
        }
        if (now()->lessThan($donor->safe_donate_at)) {
            return back()->with('status', 'Cannot Safely Donate before ' . $donor->safe_donate_at->toDateString());
        }

        return view('bank.camp.donation.found')->with('donor', $donor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
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
    public function update(Request $request, Donor $id)
    {
        dd($id, $request);
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
