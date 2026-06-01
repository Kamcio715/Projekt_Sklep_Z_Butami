<?php

namespace Tests\Feature;

use App\Models\Shoe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShoePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_shoe_page_loads_successfully(): void
    {
        $shoe = Shoe::create([
            'name' => 'Run Test',
            'brand' => 'Adidas',
            'category' => 'Sportowe',
            'type' => 'Dla kobiet',
            'size' => ['38', '39', '40', '41'],
            'price' => 299.99,
            'color' => 'Biały',
            'description' => 'Opis testowego buta',
            'image' => 'zdj/test-shoe.jpg',
            'stock' => 5,
        ]);

        $response = $this->get(route('shoes.show', $shoe));

        $response->assertStatus(200);
    }

    public function test_shoe_page_displays_basic_product_information(): void
    {
        $shoe = Shoe::create([
            'name' => 'Run Test',
            'brand' => 'Adidas',
            'category' => 'Sportowe',
            'type' => 'Dla kobiet',
            'size' => ['38', '39', '40', '41'],
            'price' => 299.99,
            'color' => 'Biały',
            'description' => 'Opis testowego buta',
            'image' => 'zdj/test-shoe.jpg',
            'stock' => 5,
        ]);

        $response = $this->get(route('shoes.show', $shoe));

        $response->assertStatus(200);
        $response->assertSeeText('Run Test');
        $response->assertSeeText('Adidas');
        $response->assertSeeText('Sportowe');
        $response->assertSeeText('Dla kobiet');
        $response->assertSeeText('Stan magazynowy: 5');
        $response->assertSeeText('299,99 PLN');
    }

    public function test_shoe_page_displays_size_select_with_available_sizes(): void
    {
        $shoe = Shoe::create([
            'name' => 'Run Test',
            'brand' => 'Adidas',
            'category' => 'Sportowe',
            'type' => 'Dla kobiet',
            'size' => ['38', '39', '40', '41'],
            'price' => 299.99,
            'color' => 'Biały',
            'description' => 'Opis testowego buta',
            'image' => 'zdj/test-shoe.jpg',
            'stock' => 5,
        ]);

        $response = $this->get(route('shoes.show', $shoe));

        $response->assertStatus(200);
        $response->assertSee('name="size"', false);
        $response->assertSeeText('Wybierz rozmiar');
        $response->assertSeeText('38');
        $response->assertSeeText('39');
        $response->assertSeeText('40');
        $response->assertSeeText('41');
    }

    public function test_shoe_page_contains_add_to_cart_form(): void
    {
        $shoe = Shoe::create([
            'name' => 'Run Test',
            'brand' => 'Adidas',
            'category' => 'Sportowe',
            'type' => 'Dla kobiet',
            'size' => ['38', '39', '40', '41'],
            'price' => 299.99,
            'color' => 'Biały',
            'description' => 'Opis testowego buta',
            'image' => 'zdj/test-shoe.jpg',
            'stock' => 5,
        ]);

        $response = $this->get(route('shoes.show', $shoe));

        $response->assertStatus(200);
        $response->assertSee('id="add-to-cart-form"', false);
        $response->assertSee(route('cart.add', $shoe), false);
        $response->assertSee('name="quantity"', false);
        $response->assertSeeText('Dodaj do koszyka');
        $response->assertSeeText('Przejdź do koszyka');
    }

    public function test_guest_sees_login_prompt_for_review_section(): void
    {
        $shoe = Shoe::create([
            'name' => 'Run Test',
            'brand' => 'Adidas',
            'category' => 'Sportowe',
            'type' => 'Dla kobiet',
            'size' => ['38', '39', '40', '41'],
            'price' => 299.99,
            'color' => 'Biały',
            'description' => 'Opis testowego buta',
            'image' => 'zdj/test-shoe.jpg',
            'stock' => 5,
        ]);

        $response = $this->get(route('shoes.show', $shoe));

        $response->assertStatus(200);
        $response->assertSee(route('login'), false);
        $response->assertSeeText('Zaloguj się');
        $response->assertSeeText('Zaloguj się, aby dodać opinię.');
    }

    public function test_authenticated_user_sees_review_form(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $shoe = Shoe::create([
            'name' => 'Run Test',
            'brand' => 'Adidas',
            'category' => 'Sportowe',
            'type' => 'Dla kobiet',
            'size' => ['38', '39', '40', '41'],
            'price' => 299.99,
            'color' => 'Biały',
            'description' => 'Opis testowego buta',
            'image' => 'zdj/test-shoe.jpg',
            'stock' => 5,
        ]);

        $response = $this->actingAs($user)->get(route('shoes.show', $shoe));

        $response->assertStatus(200);
        $response->assertSeeText('Dodaj swoją opinię');
        $response->assertSee(route('reviews.store', $shoe), false);
        $response->assertSee('name="rating"', false);
        $response->assertSee('name="content"', false);
        $response->assertSeeText('Twoja opinia');
        $response->assertSeeText('Dodaj opinię');
    }

    public function test_shoe_page_passes_correct_shoe_to_view(): void
    {
        $shoe = Shoe::create([
            'name' => 'Run Test',
            'brand' => 'Adidas',
            'category' => 'Sportowe',
            'type' => 'Dla kobiet',
            'size' => ['38', '39', '40', '41'],
            'price' => 299.99,
            'color' => 'Biały',
            'description' => 'Opis testowego buta',
            'image' => 'zdj/test-shoe.jpg',
            'stock' => 5,
        ]);

        $response = $this->get(route('shoes.show', $shoe));

        $response->assertStatus(200);
        $response->assertViewHas('shoe', function ($viewShoe) use ($shoe) {
            return $viewShoe->id === $shoe->id
                && $viewShoe->name === $shoe->name
                && $viewShoe->brand === $shoe->brand
                && $viewShoe->stock === $shoe->stock;
        });
    }

    public function test_product_without_reviews_shows_no_reviews_message(): void
    {
        $shoe = Shoe::create([
            'name' => 'Run Test',
            'brand' => 'Adidas',
            'category' => 'Sportowe',
            'type' => 'Dla kobiet',
            'size' => ['38', '39', '40', '41'],
            'price' => 299.99,
            'color' => 'Biały',
            'description' => 'Opis testowego buta',
            'image' => 'zdj/test-shoe.jpg',
            'stock' => 5,
        ]);

        $response = $this->get(route('shoes.show', $shoe));

        $response->assertStatus(200);
        $response->assertSeeText('Brak opinii');
        $response->assertSeeText('Ten produkt nie ma jeszcze opinii.');
    }
}