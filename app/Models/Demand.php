<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;

    protected $fillable = [
        'guardian_name',
        'contact_email',
        'contact_phone',
        'recipient_name',
        'blood_group',
        'blood_component',
        'compatible_groups',
        'buffer_days',
        'required_at',
        'required_units',
        'status',
        'no_substitute',
        'is_donor',
    ];

    protected $casts = [
        'contact_phone' => 'encrypted',
        'no_substitute' => 'boolean',
        'is_donor' => 'boolean',
        'compatible_groups' => 'array',
        'required_at' => 'datetime:Y-m-d',
    ];
}
