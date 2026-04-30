<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some users if not exist
        $users = User::factory()->count(5)->create(['role' => 'user']);

        // Create orders
        Order::factory()->count(10)->create([
            'user_id' => $users->random()->id,
        ])->each(function ($order) {
            // Create order items
            $products = Product::inRandomOrder()->take(rand(1, 5))->get();
            foreach ($products as $product) {
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => rand(1, 3),
                    'total' => $product->price * rand(1, 3),
                ]);
            }

            // Update order total
            $order->total = $order->items->sum('total');
            $order->save();
        });
    }
}