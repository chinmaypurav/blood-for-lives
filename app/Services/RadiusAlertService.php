<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\Demand;

class RadiusAlertService
{
    private $demandId;

    public function __construct()
    {
        
    }

    public static function dispatch(Bank $bank, Demand $demand)
    {
        $breakCount = $demand->required_units;

        $lat = $bank->lat;
        $lon = $bank->lon;

        $raw = "3956 * 2 * ASIN(SQRT(
            POWER(SIN(($lat - abs(postal_codes.lat)) * pi()/180 / 2),
            2) + COS($lat * pi()/180 ) * COS(abs(postal_codes.lat) *
            pi()/180) * POWER(SIN(($lon- postal_codes.lon) *
            pi()/180 / 2), 2) )) as distance, pincode";

        $minRadius = $demand->ada_range * 5 / 1.6;
        $maxRadius = ++$demand->ada_range * 5 / 1.6;

        do {
            
            $pincodes = DB::table('postal_codes')
                ->select(DB::raw($raw))
                ->orderBy('distance')
                ->havingBetween('distance', [$minRadius, $maxRadius])
                //->havingRaw('distance >= ?', [5])
                ->get();
            
            foreach ($pincodes as $key => $pincode) {
                $postal[] = $pincode->pincode;
            }
            // dd($pincodes);
            $minRadius += 5;
            $maxRadius += 5;
            echo $minRadius . "<br/>";
        } while (count($pincodes) === 0 && $minRadius < 100);

        $donors = Donor::whereIn('postal', $postal)
                        ->whereIn('blood_group', $demand->compatible_group)
                        ->where('safe_donate_at', '>=', now())
                        ->with('user')
                        ->get();
                        
        $batch = Bus::batch([
            new AdaMailProcess($donors, $demand->compatible_group, $demand->recipient_component),
        ])->dispatch();

        Demand::where('id', $request->demandId)
                ->update(['ada_range' => $minRadius / 5]);
        //$batch->add();

        return $batch;
    }
}