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
        'date_of_birth',
        'latitude',
        'longitude',
        'donor_card_no',
        'safe_donate_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dob' => 'date',
        'contact' => 'encrypted',
        'safe_donate_at' => 'datetime:Y-m-d',
        //'contact' => Encrypt::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function banks()
    {
        return $this->belongsToMany(Bank::class)
                ->withPivot('donated_at', 'editor')
                ->orderByDesc('donated_at');
                //->using(Donor::class);
    }

    public function donations()
    {
        return $this->belongsToMany(Bank::class)
                ->withPivot('blood_component', 'donated_at')
                ->orderByDesc('donated_at');
    }
}
