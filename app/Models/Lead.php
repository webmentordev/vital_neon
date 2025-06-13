<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        "uuid",
        "name",
        "email",
        "phone_number",
        "location",
        "dimensions",
        "budget",
        "message",
        "logos", 
        "is_completed", 
        "user_agent", 
        "ip_address", 
        "source"
    ];
}
