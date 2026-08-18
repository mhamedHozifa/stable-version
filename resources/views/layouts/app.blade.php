<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Store')</title>
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    @if(isset($themePage))
        <link rel="stylesheet" href="{{ theme_css($themePage) }}">
    @else
        <link rel="stylesheet" href="{{ theme_css('store') }}">
    @endif
</head>
<body class="{{ $siteType }}-theme">
    <header class="site-header">
        <div class="site-container header-content">
            <a href="{{ route('shop.products.index') }}" class="brand"><b><h2>Flexishope</h2></b></a>
            <input type="checkbox" id="mobile-nav-toggle" class="mobile-nav-toggle" hidden>
            <label for="mobile-nav-toggle" class="mobile-nav-toggle-label" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </label>
            @php
                $navCategories = \App\Models\Category::where('site_type', $siteType)->get();
            @endphp
            <nav class="header-nav">
                @if($navCategories->isNotEmpty())
                    <div class="category-dropdown">
                        <button type="button" class="category-dropdown-toggle">Categories</button>
                        <div class="category-dropdown-menu">
                            @foreach($navCategories as $navCat)
                                <a href="{{ route('shop.products.by.category', $navCat) }}">{{ $navCat->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
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
