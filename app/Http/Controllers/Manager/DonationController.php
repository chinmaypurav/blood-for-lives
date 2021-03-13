<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use App\Models\Donor;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\DonationSearchRequest;
use App\Http\Controllers\Imports\CompatibilityController;

class DonationController extends Controller
{
    private $user;
    private $bank;

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            $this->user = auth()->user();
            $this->bank = $this->user->bank;
            
            return $next($request);
        });
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Donation::first()->donor->id);
        $donations = $this->bank->donors;
        return view('manager.donation.index')->with('donations', $donations);
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
    public function store(Request $request)
    {
        //$validated = $request->validated();

    
        $donor = Donor::find($request->donorId);

        $donor->banks()->attach($this->bank->id, [
            'blood_component' => $request->bloodComponent,
            //'editor' => $user->email,
        ]);

        $compatibility = new CompatibilityController();

        $safeDonate = $compatibility->safeDonate($request->bloodComponent);

        Donor::where('id', $donor->id)
            ->update(['safe_donate_at' => $safeDonate]);

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
    
        return view('manager.donation.show')->with(['donor' => $donor, 'donatedAt' => $donation]);
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

    /**
     * Search for existing Donor model in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(DonationSearchRequest $request)
    {
        $validated = $request->validated();

        if ($validated["donorCardNo"] ?? false) {
            $donor = Donor::where('donor_card_no', $validated["donorCardNo"])->first();
        } elseif($validated["email"] ?? false) {
            $donor = User::where('email', $validated["email"])->first();
            $donor = $donor ? $donor->donor : null;
        }


        if (!$donor) {
            return back()->with('status', 'Invalid donor details');
        }
        
        //If found, check for status_code and last donated;

        // dd($diff, now()->toDateTimeString(), now()->tzName,$donor->safe_donate_at->toDateTimeString(), $donor->safe_donate_at->tzName);

        if (now()->lessThan($donor->safe_donate_at)) {
            return back()->with('status', 'Cannot Safely Donate before ' . $donor->safe_donate_at->toDateString());
        }

        return view('manager.donation.found')->with('donor', $donor);
    }
}
