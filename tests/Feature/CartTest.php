<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Services\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cart = app(Cart::class);
    }

    public function test_guest_can_add_product_to_cart()
    {
        $product = Product::factory()->create();

        $response = $this->post(route('cart.add', $product), [
            'quantity' => 1
        ]);

        $response->assertRedirect();
        $this->assertEquals(1, $this->cart->getCount());
    }

    public function test_cart_page_displays_added_product()
    {
        $product = Product::factory()->create();

        $this->post(route('cart.add', $product), ['quantity' => 1]);

        $response = $this->get(route('cart.index'));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_quantity_can_be_updated()
    {
        $product = Product::factory()->create();

        $this->post(route('cart.add', $product), ['quantity' => 1]);

        $response = $this->patch(route('cart.update', $product), [
            'quantity' => 3
        ]);

        $response->assertRedirect();
        $this->assertEquals(3, $this->cart->getItems()[0]['quantity']);
    }

    public function test_product_can_be_removed()
    {
        $product = Product::factory()->create();

        $this->post(route('cart.add', $product), ['quantity' => 1]);

        $response = $this->delete(route('cart.remove', $product));

        $response->assertRedirect();
        $this->assertEquals(0, $this->cart->getCount());
    }

    public function test_cart_count_updates_correctly()
    {
        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();

        $this->post(route('cart.add', $product1), ['quantity' => 2]);
        $this->post(route('cart.add', $product2), ['quantity' => 3]);

        $this->assertEquals(5, $this->cart->getCount());
    }

    public function test_cart_total_calculates_correctly()
    {
        $product = Product::factory()->create(['price' => 10.00]);

        $this->post(route('cart.add', $product), ['quantity' => 2]);

        $this->assertEquals(20.00, $this->cart->getTotal());
    }

    public function test_adding_same_product_increments_quantity()
    {
        $product = Product::factory()->create();

        $this->post(route('cart.add', $product), ['quantity' => 1]);
        $this->post(route('cart.add', $product), ['quantity' => 2]);

        $this->assertEquals(3, $this->cart->getCount());
        $this->assertEquals(1, count($this->cart->getItems()));
    }

    public function test_attempting_to_add_invalid_product_returns_404()
    {
        $response = $this->post(route('cart.add', 999), ['quantity' => 1]);

        $response->assertStatus(404);
    }

    public function test_authenticated_user_can_access_checkout()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);
        $this->post(route('cart.add', $product), ['quantity' => 1]);

        $response = $this->get(route('cart.checkout'));

        $response->assertStatus(200);
        $response->assertSee('Checkout');
    }

    public function test_checkout_creates_order()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['price' => 50.00]);

        $this->actingAs($user);
        $this->post(route('cart.add', $product), ['quantity' => 2]);

        $response = $this->post(route('cart.process-checkout'), [
            'shipping_address' => '123 Main St',
            'billing_address' => '456 Elm St',
            'payment_method' => 'credit_card',
            'notes' => 'Test order',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'total' => 100.00,
            'shipping_address' => '123 Main St',
            'billing_address' => '456 Elm St',
            'payment_method' => 'credit_card',
            'notes' => 'Test order',
        ]);
        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 2,
            'total' => 100.00,
        ]);
        $this->assertEquals(0, $this->cart->getCount());
    }

    public function test_checkout_requires_items_in_cart()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('cart.checkout'));

        $response->assertRedirect(route('cart.index'));
    }
}
