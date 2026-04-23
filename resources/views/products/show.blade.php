@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <nav class="breadcrumbs">
        <a href="{{ route('shop.products.index') }}">Products</a>
        <span>/</span>
        <span>{{ $product->name }}</span>
    </nav>

    <section class="product-show">
        <div class="product-show-image">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        </div>

        <div class="product-show-content">
            <h1>{{ $product->name }}</h1>
            <p class="price">${{ number_format($product->price, 2) }}</p>
            <p class="description">{{ $product->description ?: 'No description available yet.' }}</p>

            <div class="quantity-row">
                <label for="qty">Qty</label>
                <input id="qty" type="number" min="1" value="1">
                <button type="button">Add to Cart</button>
            </div>

            <a href="{{ route('shop.products.index') }}" class="back-link">Back to products</a>
        </div>
    </section>
@endsection
