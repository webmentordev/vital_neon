<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'message',
        'name',
        'image',
        'size',
        'location',
        'budget',
    ];
}
