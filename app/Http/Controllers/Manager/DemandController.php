<?php

namespace App\Http\Controllers\Manager;

use App\Models\Demand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manager\CompatibilityController;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $bank = $user->banks->first();
        
        $demands = $bank->demands;

        $whole = [
            'A+' => ['A+', 'AB+'],
            'A-' => ['A-', 'AB-'],
            'B+' => ['B+', 'AB+'],
            'B-' => ['B-', 'AB-'],
            'AB+' => ['AB+'],
            'AB-' => ['AB-'],
            'O+' => ['A+', 'B+', 'AB+', 'O+'],
            'O-' => ['O-'],
        ];
        // return response()->json($whole["A+"]);
        // exit();
        //dd($demands->count());

        return view('manager.demand.index')->with('demands', $demands);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.demand.create');
        return CompatibilityController::recipient('whole', 'A+');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::connection()->enableQueryLog();

        $user = auth()->user();

        $demand = $user->banks->first()->demands();

        //dd($demand);
        $compatibleGroup = CompatibilityController::recipient($request->recipientComponent, $request->recipientGroup);

        //

        $demand->create([
            'guardian_name' => $request->guardianName,
            'guardian_contact' => $request->guardianContact,
            'recipient_name' => $request->recipientName,
            'recipient_group' => $request->recipientGroup,
            'recipient_component' => $request->recipientComponent,
            'compatible_group' => json_encode($compatibleGroup),
            'buffer_time' => 2,
            'required_at' => $request->requiredAt,
        ]);
        return $queries = DB::getQueryLog();

        Demand::where('id', $demand->id)
            ->update([
            'logger->open->id' => '',
            'logger->open->updated_at' => '99',
        ]);

        return now();




    DB::table('demands')
            ->where('id', $demand->id)
            ->update([
            'logger->open->id' => 6,
            'logger->open->updated_at' => 'today'
            ]
        );

    Demand::where('id', $demand->id)
    ->update([
    'logger->open->id' => '11',
    'logger->open->updated_at' => '99',
    ]);


    return $queries;

        

        return DB::table('demands')
            ->where('id', $demand->id)
            ->update([
            'logger' => [
                'open' => [
                    'id' => '6',
                    'updated_at' => '8',
                ]
            ]
        ]);

        

        return $json;


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
