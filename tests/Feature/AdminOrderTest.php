<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminOrderTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin user
        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);
    }

    public function test_admin_can_view_orders_list()
    {
        $this->actingAs($this->admin);

        Order::factory()->count(3)->create();

        $response = $this->get(route('admin.orders.index'));

        $response->assertStatus(200);
        $response->assertSee('Order Management');
    }

    public function test_admin_can_view_single_order()
    {
        $this->actingAs($this->admin);

        $order = Order::factory()->create();

        $response = $this->get(route('admin.orders.show', $order));

        $response->assertStatus(200);
        $response->assertSee($order->order_number);
    }

    public function test_admin_can_update_order_status()
    {
        $this->actingAs($this->admin);

        $order = Order::factory()->create(['status' => 'pending']);

        $response = $this->post(route('admin.orders.status', $order), [
            'status' => 'processing',
        ]);

        $response->assertRedirect();
        $order->refresh();
        $this->assertEquals('processing', $order->status);
    }

    public function test_admin_can_process_refund()
    {
        $this->actingAs($this->admin);

        $order = Order::factory()->create(['total' => 100.00]);

        $response = $this->post(route('admin.orders.refund', $order), [
            'amount' => 50.00,
            'reason' => 'Customer request',
        ]);

        $response->assertRedirect();
        $order->refresh();
        $this->assertEquals('partial_refund', $order->payment_status);
        $this->assertDatabaseHas('refunds', [
            'order_id' => $order->id,
            'amount' => 50.00,
            'reason' => 'Customer request',
        ]);
    }

    public function test_packing_slip_view_loads()
    {
        $this->actingAs($this->admin);

        $order = Order::factory()->create();

        $response = $this->get(route('admin.orders.packing-slip', $order));

        $response->assertStatus(200);
        $response->assertSee('Packing Slip');
        $response->assertSee($order->order_number);
    }

    public function test_non_admin_cannot_access_order_management()
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user);

        $response = $this->get(route('admin.orders.index'));

        $response->assertRedirect('/');
    }
}