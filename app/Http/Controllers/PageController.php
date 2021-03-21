<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class PageController extends Controller
{
    public function products()
    {
        return view('products', [
            'products' => Product::with('companies')->paginate(5)
        ]);
    }

    public function product(Product $product)
    {
        return view('product', ['product' => $product]);
    }
}
