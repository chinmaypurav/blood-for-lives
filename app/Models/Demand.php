<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;

    protected $fillable = [
        'guardian_name',
        'guardian_contact',
        'recipient_name',
        // 'recipient_group',
        // 'recipient_component',
        'compatible_group',
        'buffer_time',
        'required_at',
        'required_units',
        'status',
        'logger',
    ];

    protected $casts = [
        'guardian_contact' => 'encrypted',
        'compatible_group' => 'array',
        'logger' => 'array',
        'required_at' => 'datetime:Y-m-d',
    ];
}