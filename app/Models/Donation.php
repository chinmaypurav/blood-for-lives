<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $casts = [
        // 'logger' => 'array'
    ];

    protected $fillable = [
        'logger',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function banks()
    {
        return $this->belongsToMany(Bank::class);
    }
}
