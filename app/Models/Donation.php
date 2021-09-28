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

    public $with = ['bloodComponent'];

    protected $fillable = [
        'logger',
    ];

    public function donor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function bloodComponent(): BelongsTo
    {
        return $this->belongsTo(BloodComponent::class);
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
