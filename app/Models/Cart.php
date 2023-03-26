<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'text',
        'jacket',
        'font',
        'color',
        'backboard',
        'location',
        'adaptor',
        'remote',
        'email',
        'status',
        'paid',
        'order_id',
        'price',
        'price_id',
        'checkout_id'
    ];
}