<?php

namespace App\Services\Bank;

use App\Models\Inventory;
use App\Models\Camp;

class InventoryService
{
    public function index(Inventory $bank)
    {
        return $bank->camps()->paginate();
    }

    // public function store(Inventory $bank, array $validated)
    // {
    //     return $bank->camps()->create($validated);
    // }

    public function show(Camp $camp)
    {
        return $camp;
    }
}
