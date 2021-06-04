<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\BloodComponent;
use App\Models\Donor;
use App\Models\Donation;
use Illuminate\Support\Facades\DB;
use App\Services\CompatibilityService;

class DonationStoreService
{

    public function __construct(private $validated)
    {
    }

    public function store(): void
    {
        DB::transaction(function () {
            $manager = auth()->user()->manager;

            $donation = new Donation();
            $donation->donor()->associate($this->validated['donor_id']);
            $donation->bank()->associate($manager->bank_id);
            $donation->bloodComponent()->associate($this->validated['blood_component']);
            $donation->save();
            //Temp Patch
            $bloodComponent = BloodComponent::find($this->validated['blood_component'])->blood_component;
            // dd($this->validated);
            $safeDonateAt = CompatibilityService::safeDonateAt($bloodComponent);

            $donor = Donor::find($this->validated['donor_id']);
            $donor->safe_donate_at = $safeDonateAt;
            $donor->save();
        });

        return;
    }
}