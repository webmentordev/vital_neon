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
        'is_active',
        'description'
    ];

    public function categories(){
        return $this->hasMany(CategoryPrice::class);
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
