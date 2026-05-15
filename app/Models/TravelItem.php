<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelItem extends Model
{
    protected $table = 'travel_items'; // Pangalan ng table mo sa DB
    protected $fillable = ['name', 'category', 'sub_category', 'price', 'description', 'image_url', 'status'];
}