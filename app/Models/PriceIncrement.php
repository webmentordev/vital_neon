<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceIncrement extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentage',
        'is_active'
    ];
}