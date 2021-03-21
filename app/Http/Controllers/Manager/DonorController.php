<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use App\Models\Donor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DonorCreateService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Manager\DonorRequest;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.donor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.donor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonorRequest $request)
    {
        $validated = $request->validated();

        (new DonorCreateService($validated))->createUser()->createDonor();
        
        return redirect()->route('manager.donor.create')->with('status', 'Donor Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Donor $donor)
    {
        return view('manager.donor.show', ['donor' => $donor]);
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
     * Search 
     *
     *
     */
    public function search(Request $request)
    {
        return "Search Ok";
    }
}
