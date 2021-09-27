<?php

namespace App\Http\Controllers\Bank;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DonorSearchService;
use App\Http\Requests\Manager\DonationSearchRequest;
use App\Models\Camp;
use App\Services\Bank\CampDonationService;

class CampDonationController extends Controller
{
    private $campDonationService;

    public function __construct(CampDonationService $campDonationService)
    {
        $this->campDonationService = $campDonationService;
    }

    public function index(Camp $camp)
    {
        $donations = $this->campDonationService->index($camp);
        return view('bank.camp.donation.index', compact('camp', 'donations'));
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

    public function show($id)
    {
        dd($id);
    }

    public function edit($id)
    {
        //
    }

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
