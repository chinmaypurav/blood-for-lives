<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'last_donated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'date',
        'contact' => 'encrypted',
        //'safe_donate_at' => 'date',
        //'contact' => Encrypt::class,
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
