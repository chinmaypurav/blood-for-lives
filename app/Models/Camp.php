<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'postal',
        'latitude',
        'longitude',
        'camp_at',
    ];

    protected $casts = [
        'camp_at' => 'datetime:Y-m-d'
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
