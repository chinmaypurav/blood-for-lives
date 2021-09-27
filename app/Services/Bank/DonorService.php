<?php

namespace App\Services\Bank;

use App\Models\Donor;
use App\Traits\UserTrait;
use Illuminate\Support\Arr;

class DonorService
{
    use UserTrait;

    public function index()
    {
        return Donor::paginate(10);
    }

    public function store(array $validated)
    {
        $user = $this->create(Arr::only($validated, ['name', 'email', 'password']));

        $user->update([
            'blood_group_id'    => $this->validated['blood_group'],
            'contact'           => $this->validated['contact'],
            'postal'            => $this->validated['postal'],
            'date_of_birth'     => $this->validated['date_of_birth'],
            'donor_card_no'     => 'DONOR' . $user->id, //Temporary set to zero.
            'lat'               => 0, //Temporary set to zero.
            'lon'               => 0, //Temporary set to zero.
        ]);

        $user->assignRole('donor');
        $user->assignRole('recipient');
    }
}
