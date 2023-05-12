<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'top_product',
        'best_price',
        'discount',
        'price',
        'short_description',
        'available_amount'
    ];

    public function specifications()
    {
        return $this->hasMany(Specification::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function parameters()
    {
        return $this->hasOne(Parameter::class);
    }
}
