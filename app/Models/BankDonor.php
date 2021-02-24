<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


class BankDonor extends Pivot
{
        /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $fillable = [
        'id',
    ];

    public function donations()
    {
        //dd($this);
        return $this->belongsToMany(User::class)->using(RoleUser::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

}
