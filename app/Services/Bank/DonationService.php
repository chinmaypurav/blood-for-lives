<?php

namespace App\Services\Bank;

use App\Models\User;

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
}
