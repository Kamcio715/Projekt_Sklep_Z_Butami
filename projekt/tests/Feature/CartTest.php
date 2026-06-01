<?php

namespace Tests\Feature;

use App\Models\Shoe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_added_to_cart_with_size(): void
    {
        $shoe = Shoe::create([
            'name' => 'Test Shoe',
            'brand' => 'Nike',
            'category' => 'Sportowe',
            'type' => 'Dla mężczyzn',
            'size' => ['40', '41', '42'],
            'price' => 199.99,
            'color' => 'Czarny',
            'description' => 'But testowy',
            'image' => 'zdj/test.jpg',
            'stock' => 5,
        ]);

        $response = $this->post(route('cart.add', $shoe), [
            'quantity' => 2,
            'size' => '41',
        ]);

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('success', 'Dodano produkt do koszyka.');

        $cart = session('cart');

        $this->assertIsArray($cart);
        $this->assertArrayHasKey($shoe->id . '_41', $cart);
        $this->assertEquals($shoe->id, $cart[$shoe->id . '_41']['id']);
        $this->assertEquals('Test Shoe', $cart[$shoe->id . '_41']['name']);
        $this->assertEquals('41', $cart[$shoe->id . '_41']['size']);
        $this->assertEquals(2, $cart[$shoe->id . '_41']['quantity']);
        $this->assertEquals(199.99, $cart[$shoe->id . '_41']['price']);
    }

    public function test_product_cannot_be_added_with_invalid_size(): void
    {
        $shoe = Shoe::create([
            'name' => 'Test Shoe',
            'brand' => 'Nike',
            'category' => 'Sportowe',
            'type' => 'Dla mężczyzn',
            'size' => ['40', '41', '42'],
            'price' => 199.99,
            'color' => 'Czarny',
            'description' => 'But testowy',
            'image' => 'zdj/test.jpg',
            'stock' => 5,
        ]);

        $response = $this->from(route('shoes.show', $shoe))->post(route('cart.add', $shoe), [
            'quantity' => 1,
            'size' => '46',
        ]);

        $response->assertRedirect(route('shoes.show', $shoe));
        $response->assertSessionHas('error', 'Wybrano nieprawidłowy rozmiar.');

        $this->assertEmpty(session('cart', []));
    }

    public function test_product_cannot_be_added_when_quantity_exceeds_stock(): void
    {
        $shoe = Shoe::create([
            'name' => 'Test Shoe',
            'brand' => 'Nike',
            'category' => 'Sportowe',
            'type' => 'Dla mężczyzn',
            'size' => ['40', '41', '42'],
            'price' => 199.99,
            'color' => 'Czarny',
            'description' => 'But testowy',
            'image' => 'zdj/test.jpg',
            'stock' => 2,
        ]);

        $response = $this->from(route('shoes.show', $shoe))->post(route('cart.add', $shoe), [
            'quantity' => 3,
            'size' => '41',
        ]);

        $response->assertRedirect(route('shoes.show', $shoe));
        $response->assertSessionHas('error', 'Nie ma tyle produktów w magazynie.');

        $this->assertEmpty(session('cart', []));
    }

    public function test_cart_item_quantity_can_be_updated(): void
    {
        $shoe = Shoe::create([
            'name' => 'Test Shoe',
            'brand' => 'Nike',
            'category' => 'Sportowe',
            'type' => 'Dla mężczyzn',
            'size' => ['40', '41', '42'],
            'price' => 199.99,
            'color' => 'Czarny',
            'description' => 'But testowy',
            'image' => 'zdj/test.jpg',
            'stock' => 5,
        ]);

        $cartKey = $shoe->id . '_41';

        $this->withSession([
            'cart' => [
                $cartKey => [
                    'id' => $shoe->id,
                    'cart_key' => $cartKey,
                    'name' => $shoe->name,
                    'brand' => $shoe->brand,
                    'size' => '41',
                    'description' => $shoe->description,
                    'type' => $shoe->type,
                    'price' => $shoe->price,
                    'quantity' => 1,
                    'stock' => $shoe->stock,
                    'image' => $shoe->image,
                ],
            ],
        ]);

        $response = $this->post(route('cart.update', $cartKey), [
            'quantity' => 3,
        ]);

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('success', 'Ilość została zaktualizowana.');

        $cart = session('cart');

        $this->assertEquals(3, $cart[$cartKey]['quantity']);
    }

    public function test_cart_item_can_be_removed(): void
    {
        $shoe = Shoe::create([
            'name' => 'Test Shoe',
            'brand' => 'Nike',
            'category' => 'Sportowe',
            'type' => 'Dla mężczyzn',
            'size' => ['40', '41', '42'],
            'price' => 199.99,
            'color' => 'Czarny',
            'description' => 'But testowy',
            'image' => 'zdj/test.jpg',
            'stock' => 5,
        ]);

        $cartKey = $shoe->id . '_41';

        $this->withSession([
            'cart' => [
                $cartKey => [
                    'id' => $shoe->id,
                    'cart_key' => $cartKey,
                    'name' => $shoe->name,
                    'brand' => $shoe->brand,
                    'size' => '41',
                    'description' => $shoe->description,
                    'type' => $shoe->type,
                    'price' => $shoe->price,
                    'quantity' => 1,
                    'stock' => $shoe->stock,
                    'image' => $shoe->image,
                ],
            ],
        ]);

        $response = $this->post(route('cart.remove', $cartKey));

        $response->assertSessionHas('success', 'Usunięto produkt z koszyka.');
        $this->assertEmpty(session('cart', []));
    }

    public function test_cart_can_be_cleared(): void
    {
        $shoe = Shoe::create([
            'name' => 'Test Shoe',
            'brand' => 'Nike',
            'category' => 'Sportowe',
            'type' => 'Dla mężczyzn',
            'size' => ['40', '41', '42'],
            'price' => 199.99,
            'color' => 'Czarny',
            'description' => 'But testowy',
            'image' => 'zdj/test.jpg',
            'stock' => 5,
        ]);

        $cartKey = $shoe->id . '_41';

        $this->withSession([
            'cart' => [
                $cartKey => [
                    'id' => $shoe->id,
                    'cart_key' => $cartKey,
                    'name' => $shoe->name,
                    'brand' => $shoe->brand,
                    'size' => '41',
                    'description' => $shoe->description,
                    'type' => $shoe->type,
                    'price' => $shoe->price,
                    'quantity' => 2,
                    'stock' => $shoe->stock,
                    'image' => $shoe->image,
                ],
            ],
        ]);

        $response = $this->post(route('cart.clear'));

        $response->assertSessionHas('success', 'Koszyk został wyczyszczony.');
        $this->assertEmpty(session('cart', []));
    }
}