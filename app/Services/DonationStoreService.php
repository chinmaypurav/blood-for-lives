<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\Donor;
use App\Services\CompatibilityService;

class DonationStoreService
{
    private static $validated;

    public function __construct(array $validated)
    {
        $this->$validated = $validated;
    }

    public static function run(array $validated, Bank $bank)
    {
        self::$validated = $validated;

        $donor = Donor::find($validated['donor_id']);
        dd($validated);
        $donation = Donation::create($validated);

        $donor->banks()->attach($bank->id, [
            'blood_component' => $validated['blood_component'],
        ]);
        $safeDonateAt = CompatibilityService::safeDonateAt($validated['blood_component']);

        $donor->update(['safe_donate_at' => $safeDonateAt]);
        return;
    }
}