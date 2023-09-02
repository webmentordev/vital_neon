<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "quantity",
        "price",
        "slug",
        "name",
        "details",
        "address_id",
        "checkout_id",
        "status",
        "shipping"
    ];
}
