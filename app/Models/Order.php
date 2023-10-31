<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "quantity",
        "price",
        "slug",
        "color",
        "name",
        "details",
        "address_id",
        "checkout_id",
        "status",
        "shipping"
    ];

    public function address(){
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
}
