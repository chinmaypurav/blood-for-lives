<?php

namespace App\Services\Bank;

use App\Models\Bank;

class CampService
{
    public function index(Bank $bank)
    {
        return $bank->camps()->paginate();
    }

    public function store()
    {
        # code...
    }
}
