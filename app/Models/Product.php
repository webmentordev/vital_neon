<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'body',
        'image',
        'slug',
        'stripe_id',
        'category_id',
        'featured',
        'description'
    ];

    public function categories(){
        return $this->hasMany(CategoryPrice::class);
    }
}
