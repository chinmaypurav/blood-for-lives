<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use App\Models\Donor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\DonationSearchRequest;
use App\Http\Controllers\Manager\CompatibilityController;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 1;
        $donors = Donor::all();
        return view('manager.donation.index')->with('donors', $donors);
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
        $user = auth()->user();
        $bank = $user->bank;
    
        $donor = Donor::find($request->donorId);

        $donor->banks()->attach($bank->id, [
            'blood_component' => $request->bloodComponent,
            //'editor' => $user->email,
        ]);

        $safeDonate = CompatibilityController::safeDonate($request->bloodComponent);


        Donor::where('id', $donor->id)
            ->update(['safe_donate_at' => $safeDonate]);

        

        return redirect()->route('manager.donation.index')->with('status', 'Donation Entry added!');
        //return 1;
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
        $diff = date_diff(date_create($donor->safe_donate_at), date_create());


        if ($diff->format('%a') > 0) {


            return back()->with('status', 'Cannot Safely Donate before ' . $donor->safe_donate_at);
            
        }

        
        return view('manager.donation.found')->with('donor', $donor);
    }
}
