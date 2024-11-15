<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Inertia\Inertia;
use Request;

class ProductController extends Controller
{
   public function index()
   {
        $data['products'] = Product::all();
        return Inertia::render('Frontend/Products/ProductSearch', $data);
   }

   public function buy($product_id, $quantity)
   {
      $product = Product::where('id', $product_id)->first();
      $cart = Cart::where('user_id', auth()->user()->id)->first();
      Cart::where('user_id', auth()->user()->id)->update(['total'=> (int)$cart->total + (int)($product->price * $quantity)]);
      CartItem::create(['cart_id' => $cart->id, 'product_id' => $product_id, 'quantity' => $quantity]);

      return redirect()->route('cart.index');
   }

   public function addtocart($product_id, $quantity)
   {
      $product = Product::where('id', $product_id)->first();
      $cart = Cart::where('user_id', auth()->user()->id)->first();
      Cart::where('user_id', auth()->user()->id)->update(['total'=> (int)$cart->total + (int)($product->price * $quantity) ]);
      CartItem::create(['cart_id' => $cart->id, 'product_id' => $product_id, 'quantity' => $quantity]);

      return redirect()->route('product.index');
   }
}
