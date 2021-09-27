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
        return view('bank.donor.index', compact('donors'));
    }

    public function create()
    {
        $bloodGroups = BloodGroup::all(['id', 'blood_group']);
        return view('bank.donor.create', compact('bloodGroups'));
    }

    public function store(DonorRequest $request)
    {
        $this->donorService->store($request->validated());

        // $validated = $request->validated();

        // (new DonorCreateService($validated))->create();

        return redirect()->route('bank.donor.create')->with('status', 'Donor Added!');
    }

    public function show(Donor $donor)
    {
        return view('bank.donor.show', compact('donor'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

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
