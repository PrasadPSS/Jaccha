<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity'
    ];
}
