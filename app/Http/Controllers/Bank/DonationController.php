<?php

namespace App\Http\Controllers\Bank;

use App\Models\User;
use App\Models\Donor;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DonorSearchService;
use App\Services\DonationStoreService;
use App\Http\Requests\Manager\DonorRequest;
use App\Http\Requests\Manager\DonationRequest;
use App\Http\Requests\Manager\DonationSearchRequest;
use App\Http\Controllers\Imports\CompatibilityController;
use App\Models\BloodComponent;
use App\Services\Bank\DonationService;
use Illuminate\Contracts\View\View;

class DonationController extends Controller
{
    private $donationService;

    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

    public function index(): View
    {
        $donations = $this->donationService->index(auth()->user());

        return view('bank.donation.index', compact('donations'));
    }

    public function create()
    {
        return view('bank.donation.create');
    }

    public function store(DonationRequest $request)
    {
        $this->donationService->store(auth()->user(), $request->validated());
        // dd($validated);
        // $donationStore = new DonationStoreService($validated);
        // $donationStore->store();
        // DonationStoreService::run($validated, $this->user->manager->bank);
        return redirect()->route('bank.donations.search')->with('status', 'Donation Entry added to process!');
    }

    public function show($id)
    {
        $donor = Donor::find($id);
        $bank = $donor->banks->first();

        //Check if Donation transaction exists
        if (!empty($bank)) {
            $donation = $bank->pivot->donated_at;
        } else {
            $donation = null;
        }

        return view('manager.donation.show')->with(['donor' => $donor, 'donated_at' => $donation]);
    }

    public function edit($id)
    {
        //
    }

    public function update(DonationRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function search(DonationSearchRequest $request)
    {
        $validated = $request->validated();
        $donor = DonorSearchService::run($validated);

        if (!$donor) {
            return back()->with('status', 'Invalid donor details');
        }
        if (now()->lessThan($donor->safe_donate_at)) {
            return back()->with('status', 'Cannot Safely Donate before ' . $donor->safe_donate_at->toDateString());
        }

        $bloodComponents = config('project.blood_components');
        return view('bank.donation.found', compact('bloodComponents', 'donor'));
    }
}
