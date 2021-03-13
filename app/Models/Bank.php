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
        'manager_email',
        'address',
        'postal',
        'lat',
        'lon',
    ];

    public function camps()
    {
        return $this->hasMany(Camp::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function donors()
    {
        return $this->belongsToMany(Donor::class)
        ->withPivot('id', 'donated_at', 'blood_component', 'status');
    }

    public function demands()
    {
        return $this->hasMany(Demand::class);
    }

    public function demandOnlyBlood()
    {
        return $this->hasMany(Demand::class);
    }
}
