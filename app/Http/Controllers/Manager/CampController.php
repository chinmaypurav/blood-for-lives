<?php

namespace App\Http\Controllers\Manager;

use App\Models\Camp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\CampRequest;

class CampController extends Controller
{
    private $user;
    private $bank;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            $this->bank = $this->user->manager->bank;

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
        $camps = $this->user->manager->bank->camps;
        return view('manager.camp.index')->with('camps', $camps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.camp.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CampRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampRequest $request)
    {
        $this->bank->camps()->create($request->validated());
        return redirect()->route('manager.camp.index')->with('status', 'Camp Added Successfully');
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