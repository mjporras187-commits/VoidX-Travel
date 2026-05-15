<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'discount_percent',
        'valid_until',
        'is_active',
        'category',      // comma-separated: "Travel,Vehicle"
        'image_urls',    // JSON array of up to 3 image paths
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'valid_until' => 'date',
        'image_urls'  => 'array',
    ];
}