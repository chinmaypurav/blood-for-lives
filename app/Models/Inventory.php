<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'blood_group',
        'blood_component',
        'units',
        'sample_no',
        'is_private',
    ];

    protected $casts = [
        'is_private' => 'boolean'
    ];
}
