<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_profile_page(): void
    {
        $response = $this->get(route('profile.edit'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_verified_user_can_open_profile_page(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertStatus(200);
    }

    public function test_guest_is_redirected_from_orders_page(): void
    {
        $response = $this->get(route('orders.my'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_verified_user_can_open_orders_page(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)->get(route('orders.my'));

        $response->assertStatus(200);
    }

    public function test_login_page_loads(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function test_register_page_loads(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }
}