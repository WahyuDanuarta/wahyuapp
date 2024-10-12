<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashsale extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'diskon_price',
        'original_price',
        'category',
        'description',
        'image',
        'product_id'
    ];
    
}
