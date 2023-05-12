<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'last_name',
        'email',
        'street',
        'street_nr',
        'city',
        'psc',
        'product_id',
        'quantity',
        'status',
        'transport_name',
        'payment_name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
            ->withPivot(['product_quantity'])
            ->withTimestamps();
    }
}
