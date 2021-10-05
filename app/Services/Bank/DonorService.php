<?php

namespace App\Services\Bank;

use App\Models\Donor;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DonorService
{
    use UserTrait;
    private $donor;

    public function index()
    {
        return $user = User::role('donor')->get();
        return User::query()
            ->get();
    }

    public function store(array $validated): User
    {
        DB::transaction(function () use ($validated) {
            $password = 'password';
            $validated['password'] = $password;
            $this->donor = $this->create($validated);

            $this->donor->assignRole('donor');
            $this->donor->assignRole('recipient');
        });

        return $this->donor;
    }
}
