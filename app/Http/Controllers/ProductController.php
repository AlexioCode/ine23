<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\View\View;
use Illuminate\Http\Request;

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
    public function addToCart(Product $product, Request $request) {
        $cart = new Cart($request->session()->get('cart', null));
        $cart->Add($product);
        $request->session()->put('cart', $cart);
        // dd($cart);
        return redirect()->route('product.show', ['product' => $product->id])->with('success', 'El producto ha sido añadido al carro.');
    }
}
