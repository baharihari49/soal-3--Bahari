<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'image',
        'category',
        'stok',
        'price',
        'user_id'
    ];
}
