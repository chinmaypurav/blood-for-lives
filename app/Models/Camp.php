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
        'lat',
        'lon',
        'camp_at',
    ];

    protected $casts = [
        'camp_at' => 'datetime:Y-m-d'
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
