<?php

namespace App\Http\Controllers\Manager;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $editor = auth()->user();
        $bank = $editor->banks()->first();
    
        $donor = Donor::find($request->donorId);

        $donor->banks()->attach($bank->id, [
            'blood_component' => $request->bloodComponent,
            'editor' => $editor->email,
        ]);
        return redirect()->route('manager.donation.index')->with('status', 'Bank Added!');
        return 1;
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
}
