<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission_request extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'object',
        'description',
        'start_date',
        'end_date',
        'date',
        'place',
        'companion',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
