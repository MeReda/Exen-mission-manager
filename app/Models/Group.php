<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /** The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'percentage',
        'daily_allowance',
    ];

    /**
     * Get the users for the group.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
