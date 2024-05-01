<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LightBoxOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'email',
        'remote',
        'adaptor',
        'price',
        'checkout_id',
        'url',
        'status',
        'is_paid'
    ];
}