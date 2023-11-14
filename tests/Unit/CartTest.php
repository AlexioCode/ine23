<?php

namespace Tests\Unit;
namespace App\Models;

use Tests\TestCase;

use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertEquals;

// use PHPUnit\Framework\TestCase;

class CartTest extends TestCase {
    public static $cart;
    public static function InitializeCart(): void {
        self::$cart = new Cart();
        self::$cart->Add(Product::first());
        self::$cart->Add(Product::skip(1)->first());
        self::$cart->Add(Product::skip(1)->first());
        self::$cart->Add(Product::skip(2)->first());
        self::$cart->Add(Product::skip(2)->first());
        self::$cart->Add(Product::skip(2)->first());
    }
    public function testConstructor(): void {
        $cart = new Cart();
        $this->assertEquals([], $cart->htItem);
        $this->assertEquals(0, $cart->iTotalItems);
        $this->assertEquals(0, $cart->dTotalPrice);
    }
    public function testAdd(): void {
        self::InitializeCart();
        
        // Introducir un ítem que ya existe en el carro
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->Add(Product::first());
        $this->assertTrue(array_key_exists(Product::first()->id, self::$cart->htItem), "Fallo. El producto ya estaba en el carro y después de la inserción no existe.");
        $this->assertEquals($iPreviousTotalItems + 1, self::$cart->iTotalItems, "Fallo. El número total de ítems no se ha incrementado.");
        $this->assertTrue(abs($dPreviousTotalPrice + Product::first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El precio total no se ha sumado correctamente con el precio del producto añadido.");

        // Introducir un ítem que no existe en el carro
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->Add(Product::skip(3)->first());
        $this->assertTrue(array_key_exists(Product::skip(3)->first()->id, self::$cart->htItem), "Fallo. El producto no estaba en el carro y y después de la inserción no existe.");
        $this->assertEquals($iPreviousTotalItems + 1, self::$cart->iTotalItems, "Fallo. El número total de ítems no se ha incrementado.");
        $this->assertTrue(abs($dPreviousTotalPrice + Product::skip(3)->first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El precio total no se ha sumado correctamente con el precio del producto añadido.");
    }
    public function testRemove(): void {
        self::InitializeCart();

        // El ítem existe en el carro y hay más de uno
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->Remove(Product::skip(2)->first());
        $this->assertTrue(array_key_exists(Product::skip(2)->first()->id, self::$cart->htItem), "Fallo. El producto ha desaparecido del carrito.");
        $this->assertEquals($iPreviousTotalItems - 1, self::$cart->iTotalItems, "Fallo. El número total de ítems no ha decrementado.");
        $this->assertTrue(abs($dPreviousTotalPrice - Product::skip(2)->first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total no ha decrementado correctamente.");

         // El ítem existe en el carro y hay uno solo
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->Remove(Product::first());
        $this->assertTrue(array_key_exists(Product::first()->id, self::$cart->htItem), "Fallo. El producto ha desaparecido del carrito.");
        $this->assertEquals($iPreviousTotalItems - 1, self::$cart->iTotalItems, "Fallo. El número total de ítems no ha decrementado.");
        $this->assertTrue(abs($dPreviousTotalPrice - Product::first()->price - self::$cart->dTotalPrice) < 0.00001, "Fallo. El valor del precio total no ha decrementado correctamente.");

        // El ítem existe en el carro y hay cero
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->Remove(Product::first());
        $this->assertTrue(array_key_exists(Product::first()->id, self::$cart->htItem), "Fallo. El producto ha desaparecido del carrito.");
        $this->assertEquals($iPreviousTotalItems, self::$cart->iTotalItems, "Fallo. El número total de ítem se ha modificado.");
        $this->assertEquals($dPreviousTotalPrice, self::$cart->dTotalPrice, "Fallo. El valor del precio total se ha modificado.");

        // El ítem no existe en el carro
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->Remove(Product::skip(3)->first());
        $this->assertFalse(array_key_exists(Product::skip(3)->first()->id, self::$cart->htItem), "Fallo. El producto ha aparecido en el carrito.");
        $this->assertEquals($iPreviousTotalItems, self::$cart->iTotalItems, "Fallo. El número total de ítems ha cambiado.");
        $this->assertEquals($dPreviousTotalPrice, self::$cart->dTotalPrice, "Fallo. El precio total ha cambiado.");
    }
    public function testRemoveAll(): void {
        self::InitializeCart();

        // El ítem existe en el carro y hay más de uno
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->RemoveAll(Product::skip(1)->first());
        $this->assertFalse(array_key_exists(Product::skip(1)->first()->id, self::$cart->htItem), "Fallo. El producto no ha desaparecido del carrito.");
        $this->assertEquals($iPreviousTotalItems - 2, self::$cart->iTotalItems, "Fallo. El número total de ítems no ha decrementado.");
        $this->assertTrue(abs($dPreviousTotalPrice - (Product::skip(1)->first()->price * 2) - self::$cart->dTotalPrice) < 0.00001, "Fallo. El precio no se ha restado correctamente con el precio del producto añadido.");

        // El ítem no existe en el carro
        $iPreviousTotalItems = self::$cart->iTotalItems;
        $dPreviousTotalPrice = self::$cart->dTotalPrice;
        self::$cart->RemoveAll(Product::skip(3)->first());
        $this->assertFalse(array_key_exists(Product::skip(3)->first()->id, self::$cart->htItem), "Fallo. El producto ha aparecido en el carrito.");
        $this->assertEquals($iPreviousTotalItems, self::$cart->iTotalItems, "Fallo. El número total de ítems ha variado.");
        $this->assertEquals($dPreviousTotalPrice, self::$cart->dTotalPrice, "Fallo. El precio total ha variado.");
    }
}
