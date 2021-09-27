<?php

namespace App\Http\Controllers\Bank;

use App\Models\Donor;
use App\Models\Demand;
use App\Jobs\AdaMailProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\Controller;
use App\Services\RadiusAlertService;
use App\Http\Controllers\Manager\CompatibilityController;

class AdaController extends Controller
{
    public function create($id)
    {
        $user = auth()->user();
        $bank = $user->bank;

        $demand = Demand::find($id);
        $breakCount = 1;

        $lat = $bank->lat;
        $lon = $bank->lon;

        $raw = "3956 * 2 * ASIN(SQRT(
            POWER(SIN(($lat - abs(postal_codes.lat)) * pi()/180 / 2),
            2) + COS($lat * pi()/180 ) * COS(abs(postal_codes.lat) *
            pi()/180) * POWER(SIN(($lon- postal_codes.lon) *
            pi()/180 / 2), 2) )) as distance, pincode";

        $pincodes = DB::table('postal_codes')
            ->select(DB::raw($raw))
            ->orderBy('distance')
            //->havingRaw('distance >= ?', [5])
            ->get();
        
        $distance = [];
        
        foreach ($pincodes as $key => $pincode) {
            if ($key == $breakCount) {
                break;
            }
            $postal[] = $pincode->pincode;
            array_push($distance, [$pincode->pincode => $pincode->distance]);
        }


        $donors = Donor::whereIn('postal', $postal)
                        ->whereIn('blood_group', $demand->compatible_group)
                        ->where('safe_donate_at', '>=', now())
                        ->with('user')
                        ->get();
        return view('manager.ada.create')->with(['demandId' => $id, 'distance' => $distance]);
    }


    public function store(Request $request)
    {
        $user = auth()->user();
        $bank = $user->bank;

        RadiusAlertService::dispatch($bank, Demand::find($request->demandId));
        
        exit;
        

        $raw = "3956 * 2 * ASIN(SQRT(
            POWER(SIN(($lat - abs(postal_codes.lat)) * pi()/180 / 2),
            2) + COS($lat * pi()/180 ) * COS(abs(postal_codes.lat) *
            pi()/180) * POWER(SIN(($lon- postal_codes.lon) *
            pi()/180 / 2), 2) )) as distance, pincode";

        $minRadius = $demand->ada_range * 5 / 1.6;
        $maxRadius = ++$demand->ada_range * 5 / 1.6;
        //dd($pincodes);
        
        

        exit;
    }

    public function status()
    {
        $batchId = '92e52d19-930f-463b-bb1f-a55083f3b097';

        $batch = Bus::findBatch($batchId);
        return $batch;
    }
}
