<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mission extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'object',
        'description',
        'place',
        'date',
        'start_date',
        'end_date',
        'companion',
        'budget',
        'state',
        'comment',
        'user_id'
    ];

    /**
     * Get the user that owns the mission.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the expenses for the mission.
     */

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
