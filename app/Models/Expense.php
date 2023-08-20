<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    /** the attributes that are mass assignable
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'category',
        'amount',
        'description',
        'receipt_image',
        'mission_id'
    ];

    /**
     * Get the mission that owns the expense.
     */

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
