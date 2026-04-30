<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);

        $this->cart->add($product->id, $quantity);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function index()
    {
        $items = $this->cart->getItems();
        $total = $this->cart->getTotal();

        return view('cart.index', compact('items', 'total'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'integer|min:0',
        ]);

        $quantity = $request->input('quantity', 0);

        if ($quantity == 0) {
            $this->cart->remove($product->id);
            return redirect()->back()->with('success', 'Product removed from cart.');
        } else {
            $this->cart->update($product->id, $quantity);
            return redirect()->back()->with('success', 'Cart updated.');
        }
    }

    public function remove(Product $product)
    {
        $this->cart->remove($product->id);

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    public function clear()
    {
        $this->cart->clear();

        return redirect()->back()->with('success', 'Cart cleared.');
    }

    public function checkout()
    {
        $items = $this->cart->getItems();
        $total = $this->cart->getTotal();

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('cart.checkout', compact('items', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'billing_address' => 'nullable|string|max:500',
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer',
            'notes' => 'nullable|string|max:1000',
        ]);

        $items = $this->cart->getItems();
        $total = $this->cart->getTotal();

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::transaction(function () use ($request, $items, $total) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'status' => 'pending',
                'total' => $total,
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'notes' => $request->notes,
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'price' => $item['product']->price,
                    'quantity' => $item['quantity'],
                    'total' => $item['subtotal'],
                ]);
            }
        });

        $this->cart->clear();

        return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
    }
}
