<?php

namespace App\Services\Bank;

use App\Models\Bank;
use App\Models\Camp;
use App\Models\Inventory;
use App\Traits\ParamsFilterTrait as ParamsFilter;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    use ParamsFilter;

    // public function index(Inventory $bank)
    // {
    //     return $bank->camps()->paginate();
    // }

    // public function store(Inventory $bank, array $validated)
    // {
    //     return $bank->camps()->create($validated);
    // }

    public function index(Bank $bank, ?array $params = [])
    {
        $allowed = ['blood_component', 'blood_group'];
        $filters = $this->filter($allowed, $params);

        $inventories = $bank->inventories()->select(DB::raw('SUM(units) as units, blood_component, blood_group'))
            ->groupBy('blood_component', 'blood_group')
            ->when($filters['blood_group'], function ($q, $filter) {
                $q->having('blood_group', $filter);
            })
            ->when($filters['blood_component'], function ($q, $filter) {
                $q->having('blood_component', $filter);
            })
            ->get();

        return $inventories;
    }
}
