<?php

namespace App\Http\Controllers\Manager;

use App\Models\Donor;
use App\Models\Demand;
use App\Jobs\AdaMailProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manager\CompatibilityController;

class BoloController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $bank = $user->bank;

        $demand = Demand::find($request->demandId);

        //$compatibility = new CompatibilityController();

        //$groups = $compatibility->recipient($demand->component, $group)


        $lat = $bank->lat;
        $lon = $bank->lon;

        $raw = "3956 * 2 * ASIN(SQRT(
            POWER(SIN(($lat - abs(postal_codes.lat)) * pi()/180 / 2),
            2) + COS($lat * pi()/180 ) * COS(abs(postal_codes.lat) *
            pi()/180) * POWER(SIN(($lon- postal_codes.lon) *
            pi()/180 / 2), 2) )) as distance, pincode";

        $pincodes = DB::table('postal_codes')
            ->select(DB::raw($raw))
            //->havingRaw('distance >= ?', [5])
            ->get();
        
        foreach ($pincodes as $pincode) {
            $postal[] = $pincode->pincode;
        }

        $donors = Donor::whereIn('postal', $postal)
                        ->whereIn('blood_group', $demand->compatible_group)
                        ->where('safe_donate_at', '>=', now())
                        ->with('user')
                        ->get();
        
        //Dispatch Mail
        AdaMailProcess::dispatch($donors, $demand->compatible_group, $demand->recipient_component);


        dd("Success");
        dd('ADA method'); 
    }
}
