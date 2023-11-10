<?php

namespace Tests\Unit;

namespace App\Models;

use Tests\TestCase;

use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;

//use PHPUnit\Framework\TestCase;

class CartTest extends TestCase {

    public static function testVarDump() : void {
        $a = new Product();
        $a = Product::find(1);
        assertNull($a);
   }
    public static $cart;


    public static function InitializeCart() : void     {
        self::$cart = new Cart();
        self::$cart->add(Product::find(1));
        self::$cart->add(Product::find(2));
        self::$cart->add(Product::find(2));
        self::$cart->add(Product::find(3));
        self::$cart->add(Product::find(3));
        self::$cart->add(Product::find(3));

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
        self::$cart->add(Product::find(1)); // el item existe en el carro
        $this->assertTrue(array_key_exists($iId, self::$cart->htItem), "Fallo. El producto ya estaba en el carro y no se ha introducido");
        $this->assertEquals($iPreviousTotalItems + 1, self::$cart->iTotalItems, "Fallo. El número total de items no ha incrementado");
        $this->assertEquals($dPreviousTotalPrice + Product::first()->price, self::$cart->dTotalPrice, "Fallo. El precio no se ha sumado correctamente con el precio del producto añadido");
        $this->assertTrue(abs($dPreviousTotalPrice + Product::first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");

        $iId = Product::skip(3)->first()->id;
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->add(Product::find(4)); // el item no existe en el carro
        $this->assertTrue(array_key_exists($iId, self::$cart->htItem), "Fallo. El producto no estaba en el carro y no se ha introducido");
        $this->assertEquals($iPreviousTotalItems + 1, self::$cart->iTotalItems, "Fallo. El número total de items no ha incrementado");
        $this->assertEquals($dPreviousTotalPrice + Product::first()->price, self::$cart->dTotalPrice, "Fallo. El precio no se ha sumado correctamente con el precio del producto añadido");
        $this->assertTrue(abs($dPreviousTotalPrice + Product::first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");
    }/*
    public function testRemove(): void {
        self::InitializeCart();

        $iId = Product::skip(1)->first()->id;
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;

        self::$cart->delete($iId); // el item existe en el carro y hay más de uno
        $this->assertTrue(array_key_exists($iId, self::$cart->htItem), "Fallo. El producto ha desaparecido del carrito");
        $this->assertEquals($iPreviousTotalItems - 1, self::$cart->iTotalItems, "Fallo. El número total de items no ha decrementado");
        $this->assertEquals($dPreviousTotalPrice - Product::skip(1)->first()->price, self::$cart->dTotalPrice, "Fallo. El precio no se ha sumado correctamente con el precio del producto añadido");
        $this->assertTrue(abs($dPreviousTotalPrice - Product::skip(1)->first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");
        // el item existe en el carro y hay uno
        // el item existe en el carro y hay cero
        // el item no existe en el carro
    }
    public function testRemoveAll(): void {
        self::InitializeCart();

        // el item existe en el carro y hay uno
        // el item no existe en el carro
    }*/
}
