<?php

namespace App\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Jobs\PostalCsvProcess;
use App\Http\Controllers\Controller;

class PostalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $csv = array_map('str_getcsv', file($request->csv));

        if ($request->has('csv')) {
            $data = file($request->csv);

            //Chunk 1000 records per file
            $chunks = array_chunk($data, 500);

            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);

                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
                PostalCsvProcess::dispatch($data, $header);
            }
            
            dd(count($chunks));

        }

        return "No file";
        echo 123;
        exit;
        return 00;
    }


    public function process()
    {
        $path = resource_path('temp');
        $files = glob("$path/*.csv");

        // $header = [];

        foreach ($files as $key => $file) {
            
            unlink($file);

        }
        return "Dispatched";

        return 123;
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
