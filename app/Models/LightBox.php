<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LightBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'stripe_id',
        'type',
        'slug',
        'body',
        'light_image',
        'dark_image',
        'description',
        'price',
        'is_active',
        'is_featured'
    ];
}
