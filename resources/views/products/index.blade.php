@extends('layouts.app')

@section('title', 'Our Products')

@section('content')
    <section class="page-head">
        <h1>Our Products</h1>
        <p>Browse what is currently available in our catalog.</p>
    </section>

    {{-- Future sprint: filtering/sorting/search controls --}}
    <div class="catalog-toolbar-placeholder"></div>

    @if($products->isEmpty())
        <div class="empty-state">
            No products found. Check back later.
        </div>
    @else
        <section class="products-grid">
            @foreach($products as $product)
                <article class="product-card">
                    <a href="{{ route('shop.products.show', $product) }}" class="image-wrap">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </a>

                    <div class="product-card-body">
                        <h2>
                            <a href="{{ route('shop.products.show', $product) }}">
                                {{ $product->name }}
                            </a>
                        </h2>
                        <p class="price">${{ number_format($product->price, 2) }}</p>
                    </div>
                </article>
            @endforeach
        </section>

        <div class="pagination-wrap">
            {{ $products->links() }}
        </div>
    @endif
@endsection
