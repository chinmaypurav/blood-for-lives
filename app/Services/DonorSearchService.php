<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\User;
use App\Models\Donor;

class DonorSearchService
{
    public static function run(array $validated)
    {
        if ($validated["donor_card_no"] ?? false) {
            $donor = Donor::where('donor_card_no', $validated["donor_card_no"])->first();
        } elseif($validated["email"] ?? false) {
            $user = User::where('email', $validated["email"])->first();
        }

        return $user;
    }    
}