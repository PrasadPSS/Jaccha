<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
   public function index()
   {
        $data['products'] = Product::all();
        return Inertia::render('Frontend/Products/ProductSearch', $data);
   }
}
