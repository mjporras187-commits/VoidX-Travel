<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'travel_id',   // DINAGDAG: reference sa travel_items table
        'item_name',
        'price',
        'qty',
        'travel_date',
        'status',
    ];

    /**
     * Relationship: Booking belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Booking belongs to a Travel item (nullable)
     */
    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}