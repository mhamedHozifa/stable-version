<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Store')</title>
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <style>
        .header-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .category-dropdown {
            position: relative;
        }
        .category-dropdown-toggle {
            background: transparent;
            border: 1px solid transparent;
            color: inherit;
            padding: 0.5rem 0.85rem;
            cursor: pointer;
            font: inherit;
        }
        .category-dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 0.25rem);
            left: 0;
            min-width: 220px;
            background: white;
            border: 1px solid #ddd;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            z-index: 10;
        }
        .category-dropdown:hover .category-dropdown-menu,
        .category-dropdown:focus-within .category-dropdown-menu {
            display: block;
        }
        .category-dropdown-menu a {
            display: block;
            padding: 0.8rem 1rem;
            color: #333;
            text-decoration: none;
            white-space: nowrap;
        }
        .category-dropdown-menu a:hover {
            background: #f5f5f5;
        }
        @media (max-width: 768px) {
            .header-nav {
                flex-direction: column;
                align-items: stretch;
            }
            .category-dropdown-menu {
                position: static;
                box-shadow: none;
                border: 1px solid #ddd;
                width: 100%;
            }
        }
    </style>
</head>
<body class="{{ $siteType }}-theme">
    <header class="site-header">
        <div class="site-container header-content">
            <a href="{{ route('shop.products.index') }}" class="brand">Customizable Store</a>
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
