<?php

namespace App\Http\Controllers\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RadiusController extends Controller
{
    public function fence($lat, $lon)
    {
        $raw = "3956 * 2 * ASIN(SQRT(
            POWER(SIN(($lat - abs(postal_codes.lat)) * pi()/180 / 2),
            2) + COS($lat * pi()/180 ) * COS(abs(postal_codes.lat) *
            pi()/180) * POWER(SIN(($lon- postal_codes.lon) *
            pi()/180 / 2), 2) )) as distance";

            $pincodes = DB::table('postal_codes')
                ->select(DB::raw($raw))
                ->get();

        return $pincodes;
    }
}
