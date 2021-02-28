<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            //return file($request->mycsv);
            $data = file($request->csv);
            // $header = $data[0];
            // unset($data[0]);

            //Chunk 1000 records per file
            $chunks = array_chunk($data, 1000);

            //Convert 1000 records into a new csv file
            foreach ($chunks as $key => $chunk) {
                $name = "/tmp{$key}.csv";
                $path = resource_path("temp");
                file_put_contents($path . $name, $chunk);
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
            $data = array_map('str_getcsv', file($file));
            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }

            foreach ($data as $postal) {
                $row = array_combine($header, $postal);
                dd($row);
            }


        }

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
