<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $fillable = [
        "email",
        "name",
        "status",
        "is_sent",
        "pdf",
        "payload",
        "products"
    ];
}