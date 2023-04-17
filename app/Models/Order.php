<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'location',
        'adaptor',
        'remote',
        'email',
        'order_id',
        'price',
        'price_id',
        'checkout_id',
        'stripe_product',
        'checkout_url',
        'phone',
        'shape'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
