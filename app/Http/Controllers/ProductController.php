<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function Welcome()
    {
        $aProduct_offering = Product::Offerings();
        $aProduct_new = Product::NewProducts();
        return view('welcome',
        compact('aProduct_offering', 'aProduct_new'));
    }
    public function show(Product $product): View
    {
        return view('product.show', compact('product'));
    }
}
