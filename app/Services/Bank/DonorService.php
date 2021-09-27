<?php

namespace App\Services\Bank;

use App\Models\Donor;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Support\Arr;

class DonorService
{
    use UserTrait;

    public function index()
    {
        return $user = User::role('donor')->get();
        return User::query()
            ->get();
    }

    public function store(array $validated): User
    {
        $password = 'password';
        $validated['password'] = $password;
        $user = $this->create($validated);


        $user->assignRole('donor');
        $user->assignRole('recipient');

        return $user;
    }
}
