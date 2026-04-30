@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="cart-container">
    <h1>Shopping Cart</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($items) > 0)
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="{{ $item['product']->image_url }}" alt="{{ $item['product']->name }}" class="product-image">
                                <div>
                                    <h3>{{ $item['product']->name }}</h3>
                                    <p>{{ $item['product']->description }}</p>
                                </div>
                            </div>
                        </td>
                        <td>${{ number_format($item['product']->price, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="quantity-form">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0" class="quantity-input">
                                <button type="submit" class="update-btn">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($item['subtotal'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item['product']) }}" method="POST" class="remove-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="cart-total">
            <h2>Total: ${{ number_format($total, 2) }}</h2>
        </div>

        <div class="cart-actions">
            <a href="{{ route('shop.products.index') }}" class="continue-shopping-btn">Continue Shopping</a>
            <form action="{{ route('cart.clear') }}" method="POST" class="clear-cart-form">
                @csrf
                <button type="submit" class="clear-cart-btn">Clear Cart</button>
            </form>
            <a href="{{ route('cart.checkout') }}" class="checkout-btn">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty.</p>
        <a href="{{ route('shop.products.index') }}">Start Shopping</a>
    @endif
</div>
@endsection