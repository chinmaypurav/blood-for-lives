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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function donors()
    {
        return $this->belongsToMany(Donor::class)
        ->withPivot('id', 'donated_at', 'editor', 'blood_component', 'status_code')
        ->orderByDesc('donated_at');
    }

    public function demands()
    {
        return $this->hasMany(Demand::class);
    }
}
