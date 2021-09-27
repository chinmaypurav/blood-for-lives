<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'blood_group',
        'phone',
        'postal',
        'date_of_birth',
        'latitude',
        'longitude',
        'donor_card_no',
        'safe_donate_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
        'safe_donate_at' => 'datetime:Y-m-d',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function banks()
    {
        return $this->belongsToMany(Bank::class, 'donations');
    }

    public function manager(): HasOne
    {
        return $this->hasOne(Manager::class);
    }

    public function bloodGroup(): BelongsTo
    {
        return $this->belongsTo(BloodGroup::class);
    }
}
