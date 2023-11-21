<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{
    public function show() {
        $cart = session()->get('cart');
        return view('cart.show', ['cart' => $cart]);
    }
    public function add (Product $product, Request $request) {
        $cart = $request->session()->get('cart');
        $cart->add($product);
        $request->session()->put('cart', $cart);
        return view ('cart.show', compact(['cart']));
    }
    public function remove (Product $product, Request $request) {
        $cart = $request->session()->get('cart');
        $cart->remove($product);
        $request->session()->put('cart', $cart);
        return view ('cart.show', compact(['cart']));
    }
    public function removeAll (Product $product, Request $request) {
        $cart = $request->session()->get('cart');
        $cart->removeAll($product);
        $request->session()->put('cart', $cart);
        return view ('cart.show', compact(['cart']));
    }
    public function operation(String $sOperation, Product $product, Request $request) {
        switch($sOperation) {
            case "add":
                $this->add($product,$request);
                break;
            case "remove":
                $this->remove($product,$request);
                break;
            case "removeAll":
                $this->removeAll($product,$request);
                break;
        }     
        $cart = $request->session()->get('cart');
        return view('cart.show', compact('cart'));
    }
}
