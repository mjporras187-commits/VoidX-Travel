<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'travels';

    protected $fillable = [
        'name',
        'category',
        'sub_category',
        'destination', 
        'location',    
        'price',
        'description',
        'image_url',
        'status', // Isama natin para ma-update mo ang status (Available/Fully Booked)
    ];
}