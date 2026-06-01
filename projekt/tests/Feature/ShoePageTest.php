<?php

namespace Tests\Feature;

use App\Models\Shoe;
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

    public function test_shoe_page_displays_shoe_data(): void
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
        $response->assertSeeText('Biały');
        $response->assertSeeText('Opis testowego buta');
        $response->assertSee('299');
    }

    public function test_shoe_page_contains_available_sizes(): void
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
        $response->assertSee('form', false);
        $response->assertSee(route('cart.add', $shoe), false);
        $response->assertSee('name="size"', false);
        $response->assertSee('name="quantity"', false);
    }

    public function test_shoe_page_shows_out_of_stock_message_when_product_is_unavailable(): void
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
            'stock' => 0,
        ]);

        $response = $this->get(route('shoes.show', $shoe));

        $response->assertStatus(200);

        // Zmień ten tekst, jeśli w Twoim widoku jest inny komunikat:
        $response->assertSeeText('Niedostępny');
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
                && $viewShoe->brand === $shoe->brand;
        });
    }
}