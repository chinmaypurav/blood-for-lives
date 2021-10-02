<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    protected $casts = [
        // 'logger' => 'array'
    ];

    protected $fillable = [
        'blood_component', 'blood', 'status', 'notes',
    ];

    public function donor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function camp(): BelongsTo
    {
        return $this->belongsTo(Camp::class);
    }

    public function demand(): BelongsTo
    {
        return $this->belongsTo(Demand::class);
    }
}
