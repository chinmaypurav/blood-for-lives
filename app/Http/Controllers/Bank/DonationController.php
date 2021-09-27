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
use Illuminate\Contracts\View\View;

class DonationController extends Controller
{
    private $user;
    private $bank;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            // $this->bank = $this->user->bank;

            return $next($request);
        });
    }

    public function index(): View
    {
        $donations = $this->user->bank->donations;
        $id = $this->user->bank->id;
        $donations = Donation::whereHas('banks', function ($query) use (&$id) {
            $query->where('banks.id', $id);
        })
            ->with(['donor', 'donor.user'])
            ->paginate(5);
        return view('manager.donation.index', ['donations' => $donations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.donation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonationRequest $request)
    {
        $validated = $request->validated();
        // dd($validated);
        $donationStore = new DonationStoreService($validated);
        $donationStore->store();
        // DonationStoreService::run($validated, $this->user->manager->bank);
        return redirect()->route('manager.donation.search')->with('status', 'Donation Entry added to process!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function update(DonationRequest $request, $id)
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

    /**
     * Search for existing Donor model in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $bloodComponents = BloodComponent::all();
        return view('manager.donation.found', compact('bloodComponents', 'donor'));
    }
}