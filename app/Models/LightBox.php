<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LightBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'slug',
        'body',
        'light_image',
        'dark_image',
        'description',
        'price',
        'is_active',
        'featured'
    ];
}
