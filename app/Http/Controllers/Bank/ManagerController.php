<?php

namespace App\Http\Controllers\Bank;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\ManagerRequest;

class ManagerController extends Controller
{
    private $user;
    private $bank;

    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $this->user = auth()->user();
        //     $this->bank = $this->user->bank;
        //     // if ($this->user->hasRole('head-manager')) {
        //     //     return $next($request);
        //     // } else {
        //     //     abort(403);
        //     // }
        // });
    }

   
    public function index()
    {
        $user = auth()->user();
        //     $this->bank = $this->user->bank;
        $managers = User::where('bank_id', $user->bank_id)->paginate();
        return view('bank.manager.index', compact('managers'));
    }

    public function create()
    {
        return view('bank.manager.create');
    }

  
    public function store(ManagerRequest $request)
    {
        dd('change to invite');
        //Validate and add password to the array
        $validated = Arr::add($request->validated(), 'password', bcrypt('password'));

        //Create User under this->bank and assign Role manager
        $user = $this->bank->users()->create($validated);
        $user->assignRole('manager');

        return redirect()->route('manager.manager.index')->with('status', 'Manager Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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