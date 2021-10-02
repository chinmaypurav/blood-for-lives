<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;

    protected $fillable = [
        'guardian_name',
        'guardian_email',
        'guardian_phone',
        'recipient_name',
        'blood_group',
        'blood_component',
        'compatible_group',
        'buffer_time',
        'required_at',
        'required_units',
        'status',
        'logger',
    ];

    protected $casts = [
        'contact_phone' => 'encrypted',
        'no_substitute' => 'boolean',
        'is_donor' => 'boolean',
        'compatible_groups' => 'array',
        'required_at' => 'datetime:Y-m-d',
    ];
}