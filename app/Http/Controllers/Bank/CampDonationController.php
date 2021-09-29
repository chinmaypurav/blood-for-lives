<?php

namespace App\Http\Controllers\Bank;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DonorSearchService;
use App\Http\Requests\Manager\DonationSearchRequest;
use App\Models\Camp;
use App\Models\User;
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

    public function create(Camp $camp, Request $request)
    {
        $validated = $request->all();
        $donorCardNo = $validated['donor_card_no'] ?? null;
        $email = $validated['email'] ?? null;

        $donor = null;
        if ($validated["donor_card_no"] ?? false) {
            $donor = User::where('donor_card_no', $validated["donor_card_no"])->first();
        } elseif ($validated["email"] ?? false) {
            $donor = User::where('email', $validated["email"])->first();
        }

        return view('bank.camp.donation.create', compact('camp', 'donor'));
    }

    public function store(DonationSearchRequest $request, Camp $camp)
    {
        $donations = $this->campDonationService->store(
            $camp,
            auth()->user(),
            $request->all() //wip hack
        );

        return redirect()->route('bank.camps.donations.create', compact('camp'))
            ->with('status', 'Donation entry successful');
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

    public function destroy($id)
    {
        //
    }
}
