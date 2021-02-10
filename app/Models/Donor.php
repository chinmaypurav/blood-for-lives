<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blood_group',
        'contact',
        'postal',
        'dob',
        'lat',
        'lon',
        'donor_card_no',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }

    public function banks()
    {
        return $this->belongsToMany(Bank::class)
                ->withPivot('donated_at', 'editor')
                ->orderByDesc('donated_at');
                //->using(Donor::class);
    }
}
