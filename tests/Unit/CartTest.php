<?php

namespace Tests\Unit;

namespace App\Models;

use Tests\TestCase;

use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;

//use PHPUnit\Framework\TestCase;

class CartTest extends TestCase {

    public static $cart;

    public static function InitializeCart() : void     {
        self::$cart = new Cart();
        self::$cart->add(Product::first());
        self::$cart->add(Product::skip(1)->first());
        self::$cart->add(Product::skip(1)->first());
        self::$cart->add(Product::skip(2)->first());
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

        $iId = Product::first()->id; // el item existe en el carro
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->add(Product::first());
        $this->assertTrue(array_key_exists($iId, self::$cart->htItem), "Fallo. El producto ya estaba en el carro y no se ha introducido");
        $this->assertEquals($iPreviousTotalItems + 1, self::$cart->iTotalItems, "Fallo. El número total de items no ha incrementado");
        $this->assertEquals($dPreviousTotalPrice + Product::first()->price, self::$cart->dTotalPrice, "Fallo. El precio no se ha sumado correctamente con el precio del producto añadido");
        $this->assertTrue(abs($dPreviousTotalPrice + Product::first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");

        $iId = Product::skip(3)->first()->id; // el item no existe en el carro
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->add(Product::skip(3)->first()); 
        $this->assertTrue(array_key_exists($iId, self::$cart->htItem), "Fallo. El producto no estaba en el carro y no se ha introducido");
        $this->assertEquals($iPreviousTotalItems + 1, self::$cart->iTotalItems, "Fallo. El número total de items no ha incrementado");
        $this->assertEquals($dPreviousTotalPrice + Product::skip(3)->first()->price, self::$cart->dTotalPrice, "Fallo. El precio no se ha sumado correctamente con el precio del producto añadido");
        $this->assertTrue(abs($dPreviousTotalPrice + Product::skip(3)->first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");
    }
    public function testRemove(): void {
        self::InitializeCart();

        $iId = Product::skip(2)->first()->id; // el item existe en el carro y hay más de uno
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;

        self::$cart->remove(Product::skip(2)->first());
        $this->assertTrue(array_key_exists($iId, self::$cart->htItem), "Fallo. El producto ha desaparecido del carrito");
        $this->assertEquals($iPreviousTotalItems - 1, self::$cart->iTotalItems, "Fallo. El número total de items no ha decrementado");
        $this->assertEquals($dPreviousTotalPrice - Product::skip(2)->first()->price, self::$cart->dTotalPrice, "Fallo. El precio no se ha restado correctamente con el precio del producto añadido");
        $this->assertTrue(abs($dPreviousTotalPrice - Product::skip(2)->first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");
       
        $iId = Product::first()->id; // el item existe en el carro y hay uno
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;

        self::$cart->remove(Product::first());
        $this->assertTrue(array_key_exists($iId, self::$cart->htItem), "Fallo. El producto ha desaparecido del carrito");
        $this->assertEquals($iPreviousTotalItems - 1, self::$cart->iTotalItems, "Fallo. El número total de items no ha decrementado");
        $this->assertEquals($dPreviousTotalPrice - Product::first()->price, self::$cart->dTotalPrice, "Fallo. El precio no se ha restado correctamente con el precio del producto añadido");
        $this->assertTrue(abs($dPreviousTotalPrice - Product::first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");
        
        $iId = Product::first()->id; // el item existe en el carro y hay cero
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;

        self::$cart->remove(Product::first());
        $this->assertTrue(array_key_exists($iId, self::$cart->htItem), "Fallo. El producto ha desaparecido del carrito");
        $this->assertEquals($iPreviousTotalItems, self::$cart->iTotalItems, "Fallo. El número total de items ha cambiado");
        $this->assertEquals($dPreviousTotalPrice, self::$cart->dTotalPrice, "Fallo. El precio ha cambiado");
        $this->assertTrue(abs($dPreviousTotalPrice - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");
       
        $iId = Product::skip(3)->first()->id; // el item no existe en el carro
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;

        self::$cart->remove(Product::skip(3)->first());
        $this->assertTrue(!array_key_exists($iId, self::$cart->htItem), "Fallo. El producto ha aparecido en el carrito");
        $this->assertEquals($iPreviousTotalItems, self::$cart->iTotalItems, "Fallo. El número total de items ha cambiado");
        $this->assertEquals($dPreviousTotalPrice, self::$cart->dTotalPrice, "Fallo. El precio ha cambiado");
        $this->assertTrue(abs($dPreviousTotalPrice - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");
       
    }
    public function testRemoveAll(): void {
        self::InitializeCart();

        $iId = Product::skip(1)->first()->id; // el item existe en el carro y hay 2

        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;

        self::$cart->removeAll(Product::skip(1)->first());
        $this->assertTrue(!array_key_exists($iId, self::$cart->htItem), "Fallo. El producto no ha desaparecido del carrito");
        $this->assertEquals($iPreviousTotalItems - 2, self::$cart->iTotalItems, "Fallo. El número total de items no ha decrementado");
        $this->assertEquals($dPreviousTotalPrice - (Product::skip(1)->first()->price * 2), self::$cart->dTotalPrice, "Fallo. El precio no se ha restado correctamente con el precio del producto añadido");
        $this->assertTrue(abs($dPreviousTotalPrice - (Product::skip(1)->first()->price * 2) - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");

        $iId = Product::skip(3)->first()->id; // el item no existe

        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;

        self::$cart->removeAll(Product::skip(3)->first());
        $this->assertTrue(!array_key_exists($iId, self::$cart->htItem), "Fallo. El producto ha aparecido en el carrito");
        $this->assertEquals($iPreviousTotalItems, self::$cart->iTotalItems, "Fallo. El número total de items ha variado");
        $this->assertEquals($dPreviousTotalPrice, self::$cart->dTotalPrice, "Fallo. El precio ha variado");
        $this->assertTrue(abs($dPreviousTotalPrice - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total difiere en más de 0.00001");

    }
}
