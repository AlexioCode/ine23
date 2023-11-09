<?php

namespace Tests\Unit;
namespace App\Models;

use Tests\TestCase;
//use PHPUnit\Framework\TestCase;

class CartTest extends TestCase {
    public static $cart;
    public static function InitializeCart() { 
        self::$cart = new Cart();
        self::$cart->add(Product::first());
        self::$cart->add(Product::skip(1)->first());
        self::$cart->add(Product::skip(1)->first());
        self:: $cart->add(Product::skip(2)->first());
        self::$cart->add(Product::skip(2)->first());
        self::$cart->add(Product::skip(2)->first());
    }
    public function testConstructor(): void {
        $cart = new Cart();
        $this->assertEquals([], $cart->htItem);
        $this->assertEquals(0, $cart->iTotalItems);
        $this->assertEquals(0, $cart->dTotalPrice);
    }
    public function testAdd(): void {
        self::InitializeCart();

        $iId = Product::first()->id;
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->add(Product::first()); // el item existe en el carro
        $this->assertTrue(array_key_exists($iId, self::$cart->htItem), "Fallo. El producto ya estaba en el carro y no se ha introducido");
        $this->assertEquals($iPreviousTotalItems + 1, self::$cart->iTotalItems, "Fallo. El número total de items no ha incrementado");
        $this->assertEquals($dPreviousTotalPrice + Product::first()->price, self::$cart->dTotalPrice, "Fallo. El precio no se ha sumado correctamente con el precio del producto añadido");
        $this->assertTrue(abs($dPreviousTotalPrice + Product::first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");
       
        $iId = Product::skip(3)->first()->id;
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->add(Product::skip(3)->first()); // el item no existe en el carro
        $this->assertTrue(array_key_exists($iId, self::$cart->htItem), "Fallo. El producto no estaba en el carro y no se ha introducido");
        $this->assertEquals($iPreviousTotalItems + 1, self::$cart->iTotalItems, "Fallo. El número total de items no ha incrementado");
        $this->assertEquals($dPreviousTotalPrice + Product::first()->price, self::$cart->dTotalPrice, "Fallo. El precio no se ha sumado correctamente con el precio del producto añadido");
        $this->assertTrue(abs($dPreviousTotalPrice + Product::first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");
    
    }
    public function testRemove(): void {
        self::InitiazeCart();

        $iId = Product::first()->id;
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;

        //abs(fA – Fb) < 0.00001
    }
    public function testRemoveAll(): void {
        //abs(fA – Fb) < 0.00001
    }
}
