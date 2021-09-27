<?php

namespace App\Services\Bank;

use App\Models\Bank;
use App\Models\Camp;

class CampService
{
    public function index(Bank $bank)
    {
        return $bank->camps()->paginate();
    }

    public function store(Bank $bank, array $validated)
    {
        return $bank->camps()->create($validated);
    }

    public function show(Camp $camp)
    {
        return $camp;
    }
}
