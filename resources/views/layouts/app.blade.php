<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Store')</title>
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="site-container header-content">
            <a href="{{ route('shop.products.index') }}" class="brand">Customizable Store</a>
            <nav class="header-nav">
                <a href="{{ route('shop.products.index') }}">Products</a>
                <a href="{{ route('cart.index') }}" class="cart-link">
                    Cart
                    @php
                        $cartCount = app(\App\Services\Cart::class)->getCount();
                    @endphp
                    @if($cartCount > 0)
                        <span class="cart-count">{{ $cartCount }}</span>
                    @endif
                </a>
                @auth
                    <a href="{{ route('profile.edit') }}">My Profile</a>
                @else
                    <a href="{{ route('user.login.form') }}">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <main class="site-container">
        @yield('content')
    </main>
</body>
</html>
