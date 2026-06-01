<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Shoe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_open_checkout_page_with_cart(): void
    {
        $shoe = Shoe::create([
            'name' => 'Checkout Shoe',
            'brand' => 'Nike',
            'category' => 'Sportowe',
            'type' => 'Dla mężczyzn',
            'size' => ['40', '41', '42'],
            'price' => 199.99,
            'color' => 'Czarny',
            'description' => 'But do testu checkout',
            'image' => 'zdj/test.jpg',
            'stock' => 5,
        ]);

        $cartKey = $shoe->id . '_41';

        $response = $this->withSession([
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
        ])->get(route('checkout.index'));

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_open_checkout_page_with_cart(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $shoe = Shoe::create([
            'name' => 'Checkout Shoe',
            'brand' => 'Nike',
            'category' => 'Sportowe',
            'type' => 'Dla mężczyzn',
            'size' => ['40', '41', '42'],
            'price' => 199.99,
            'color' => 'Czarny',
            'description' => 'But do testu checkout',
            'image' => 'zdj/test.jpg',
            'stock' => 5,
        ]);

        $cartKey = $shoe->id . '_41';

        $response = $this->actingAs($user)
            ->withSession([
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
            ])
            ->get(route('checkout.index'));

        $response->assertStatus(200);
    }

    public function test_guest_can_submit_checkout_with_cart(): void
    {
        $shoe = Shoe::create([
            'name' => 'Checkout Shoe',
            'brand' => 'Nike',
            'category' => 'Sportowe',
            'type' => 'Dla mężczyzn',
            'size' => ['40', '41', '42'],
            'price' => 199.99,
            'color' => 'Czarny',
            'description' => 'But do testu checkout',
            'image' => 'zdj/test.jpg',
            'stock' => 5,
        ]);

        $cartKey = $shoe->id . '_41';

        $response = $this->withSession([
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
        ])->post(route('checkout.store'), [
            'customer_name' => 'Jan Kowalski',
            'customer_email' => 'jan@example.com',
            'customer_phone' => '123456789',
            'address' => 'ul. Testowa 1, Poznań',
            'delivery_method' => 'kurier',
            'payment_method' => 'blik',
        ]);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('shoes.index'));

        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Jan Kowalski',
            'customer_email' => 'jan@example.com',
            'address' => 'ul. Testowa 1, Poznań',
            'payment_method' => 'blik',
            'delivery_method' => 'kurier',
            'user_id' => null,
        ]);
    }

    public function test_authenticated_user_can_submit_checkout_with_cart(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $shoe = Shoe::create([
            'name' => 'Checkout Shoe',
            'brand' => 'Nike',
            'category' => 'Sportowe',
            'type' => 'Dla mężczyzn',
            'size' => ['40', '41', '42'],
            'price' => 199.99,
            'color' => 'Czarny',
            'description' => 'But do testu checkout',
            'image' => 'zdj/test.jpg',
            'stock' => 5,
        ]);

        $cartKey = $shoe->id . '_41';

        $response = $this->actingAs($user)
            ->withSession([
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
            ])
            ->post(route('checkout.store'), [
                'customer_name' => 'Jan Kowalski',
                'customer_email' => 'jan@example.com',
                'customer_phone' => '123456789',
                'address' => 'ul. Testowa 1, Poznań',
                'delivery_method' => 'kurier',
                'payment_method' => 'blik',
            ]);

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect(route('shoes.index'));

        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Jan Kowalski',
            'customer_email' => 'jan@example.com',
            'address' => 'ul. Testowa 1, Poznań',
            'payment_method' => 'blik',
            'delivery_method' => 'kurier',
            'user_id' => $user->id,
        ]);
    }

    public function test_checkout_requires_cart_items(): void
    {
        $response = $this->post(route('checkout.store'), [
            'customer_name' => 'Jan Kowalski',
            'customer_email' => 'jan@example.com',
            'customer_phone' => '123456789',
            'address' => 'ul. Testowa 1, Poznań',
            'delivery_method' => 'kurier',
            'payment_method' => 'blik',
        ]);

        $response->assertSessionHas('error');
        $response->assertRedirect(route('cart.index'));
    }
}