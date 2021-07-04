<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bank_code',
        'email',
        'address',
        'postal',
        'latitude',
        'longitude',
    ];

    public function camps()
    {
        return $this->hasMany(Camp::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function admin()
    {
        return $this->hasMany(User::class);
    }

    public function donations()
    {
        return $this->belongsToMany(Donation::class);
    }

    public function demands()
    {
        return $this->hasMany(Demand::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}