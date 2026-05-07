<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:2',
        ]);

        $items = $this->cart->getItems();
        $total = $this->cart->getTotal();

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $shippingDetails = [
            'email' => $request->email,
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
        ];

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'status' => 'pending',
            'total' => $total,
            'shipping_address' => json_encode($shippingDetails),
            'payment_status' => 'pending',
            'payment_method' => 'stripe',


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

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['product']->name,
                    ],
                    'unit_amount' => (int)($item['product']->price * 100),
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => $lineItems,
            'customer_email' => $request->email,
            'shipping_address_collection' => [
                'allowed_countries' => ['US', 'EG', 'SA'],
            ],
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
         Stripe::setApiKey(config('services.stripe.secret')); // <-- أضف هذا السطر قبل أي استدعاء
        $session = Session::retrieve($request->get('session_id'));

        if ($session->payment_status === 'paid') {
            $order = Order::find($session->metadata->order_id);
            if ($order) {
                $order->update(['status' => 'paid', 'payment_status' => 'paid']);
                $this->cart->clear();
            }
        }

        return view('checkout.success');
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}