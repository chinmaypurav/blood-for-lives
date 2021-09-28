<?php

namespace App\Services\Bank;

use App\Models\User;
use App\Models\Donation;
use App\Models\BloodComponent;
use Illuminate\Support\Facades\DB;
use App\Services\CompatibilityService;

class DonationService
{
    public function index(User $user)
    {
        $donations = $user->bank->donations()->paginate();
//        $id = $this->user->bank->id;

        // $donations = Donation::whereHas('banks', function ($query) use (&$id) {
        //     $query->where('banks.id', $id);
        // })
        //     ->with(['donor', 'donor.user'])
        //     ->paginate(5);
        return $donations;
    }

    public function store(User $user, array $validated)
    {
        DB::transaction(function () use ($user, $validated) {
            $donation = new Donation();
            $donation->donor()->associate($validated['donor_id']);
            $donation->bank()->associate($user->bank_id);
            $donation->blood_component = ($validated['blood_component']);
            $donation->save();
            //Temp Patch
            // dd($this->validated);
            $safeDonateAt = CompatibilityService::safeDonateAt($validated['blood_component']);

            $user->safe_donate_at = $safeDonateAt;
            $user->save();
        });
    }
}
