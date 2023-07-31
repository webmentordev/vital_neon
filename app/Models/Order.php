<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'adaptor',
        'remote',
        'email',
        'order_id',
        'kit',
        'price',
        'price_id',
        'checkout_id',
        'stripe_product',
        'checkout_url',
        'phone'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
