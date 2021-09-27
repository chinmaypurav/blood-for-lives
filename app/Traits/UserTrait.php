<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{
    private function create(array $validated)
    {
        $validated['password'] = Hash::make($validated['password']);
        return User::create($validated);
    }
}
