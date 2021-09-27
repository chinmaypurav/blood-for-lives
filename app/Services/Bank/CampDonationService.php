<?php

namespace App\Services\Bank;

use App\Models\Camp;

class CampDonationService
{
    public function index(Camp $camp)
    {
        return $camp->donations()->with(['donations'])->paginate();
    }
}
