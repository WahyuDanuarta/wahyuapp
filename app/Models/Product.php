<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_distributor',
        'name',
        'price',
        'category',
        'description',
        'image',
    ];

    /**
     * Relationship to FlashSale.
     * A product can be associated with many flash sales.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flashSales()
    {
        return $this->hasMany(FlashSale::class);
    }
}
