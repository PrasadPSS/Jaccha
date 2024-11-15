<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Inertia\Inertia;
use Request;

class CartController extends Controller
{
   public function index()
   {
        $data['cart'] = Cart::where('user_id', auth()->user()->id)->with('cart_items', 'cart_items.product')->first();


        return Inertia::render('Frontend/Cart/Index', $data);
   }
}
