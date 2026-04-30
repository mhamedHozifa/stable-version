<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class Cart
{
    protected $sessionKey = 'cart';

    public function add($productId, $quantity = 1)
    {
        $cart = Session::get($this->sessionKey, []);

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        Session::put($this->sessionKey, $cart);
    }

    public function update($productId, $quantity)
    {
        $cart = Session::get($this->sessionKey, []);

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        Session::put($this->sessionKey, $cart);
    }

    public function remove($productId)
    {
        $cart = Session::get($this->sessionKey, []);

        unset($cart[$productId]);

        Session::put($this->sessionKey, $cart);
    }

    public function getItems()
    {
        $cart = Session::get($this->sessionKey, []);

        $items = [];
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
            }
        }

        return $items;
    }

    public function getTotal()
    {
        $items = $this->getItems();

        return array_sum(array_column($items, 'subtotal'));
    }

    public function getCount()
    {
        $cart = Session::get($this->sessionKey, []);

        return array_sum($cart);
    }

    public function clear()
    {
        Session::forget($this->sessionKey);
    }
}