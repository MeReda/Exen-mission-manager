<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'CIN',
        'profile',
        'email',
        'password',
        'group_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get Group that the user is a member of
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get the user's missions
     */
    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    /**
     * Get the user's mission requests
     */
    public function mission_requests()
    {
        return $this->hasMany(Mission_request::class);
    }

    /**
     * Check if the user is an admin
     */
    public function isAdmin()
    {
        return $this->type == 'admin';
    }
}
