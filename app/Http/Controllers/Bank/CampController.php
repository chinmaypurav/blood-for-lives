<?php

namespace App\Http\Controllers\Bank;

use App\Models\Camp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\CampRequest;
use App\Services\Bank\CampService;

class CampController extends Controller
{
    private $campService;

    public function __construct(CampService $campService)
    {
        $this->campService = $campService;
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            $this->bank = $this->user->bank;

            return $next($request);
        });
    }

    public function index()
    {
        $camps = $this->campService->index(auth()->user()->bank);
        return view('bank.camp.index', compact('camps'));
    }

    public function create()
    {
        return view('manager.camp.create');
    }


    public function store(CampRequest $request)
    {
        $this->bank->camps()->create($request->validated());
        return redirect()->route('bank.camps.index')->with('status', 'Camp Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Camp $camp)
    {
        return view('manager.camp.show', ['camp' => $camp]);
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
