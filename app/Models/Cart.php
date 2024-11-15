<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public function cart_items()
    {
       return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
    
    protected $fillable = [
        'user_id',
        'total',
    ];
}
