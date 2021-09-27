<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use App\Models\Donor;
use App\Models\BloodGroup;
use Illuminate\Http\Request;
use App\Services\Bank\DonorService;
use App\Http\Controllers\Controller;
use App\Services\DonorCreateService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Manager\DonorRequest;

class DonorController extends Controller
{
    private $donorService;

    public function __construct(DonorService $donorService)
    {
        $this->donorService = $donorService;
    }

    public function index()
    {
        // $user = auth()->user()->manager()->bank()->id;
        $donors = $this->donorService->index();
        // dd($donors);
        return view('manager.donor.index', compact('donors'));
    }

    public function create()
    {
        $bloodGroups = BloodGroup::all();
        return view('manager.donor.create', compact('bloodGroups'));
    }

    public function store(DonorRequest $request)
    {
        $this->donorService->store($request->validated());

        $validated = $request->validated();

        (new DonorCreateService($validated))->create();

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
