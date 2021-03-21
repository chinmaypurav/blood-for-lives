<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'bank_donor';

    // protected $primaryKey = 'id';

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


}
