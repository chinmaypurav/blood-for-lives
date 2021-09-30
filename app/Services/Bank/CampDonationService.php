<?php

namespace App\Services\Bank;

use App\Models\Camp;
use App\Models\User;
use App\Models\Donation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Services\CompatibilityService;

class CampDonationService
{
    public function index(Camp $camp): LengthAwarePaginator
    {
        return $camp->donations()->with(['donor'])->paginate();
    }

    public function store(Camp $camp, User $user, array $validated)
    {
        DB::transaction(function () use ($camp, $user, $validated) {

            // $donor =

            $donation = new Donation();
            $donation->donor()->associate($validated['donor_id']);
            $donation->bank()->associate($user->bank_id);
            $donation->blood_component = ($validated['blood_component']);
            $donation->camp()->associate($camp);
            $donation->save();
            //Temp Patch
            // dd($this->validated);
            $safeDonateAt = CompatibilityService::safeDonateAt($validated['blood_component']);

            $user->safe_donate_at = $safeDonateAt;
            $user->save();
        });
    }
}
