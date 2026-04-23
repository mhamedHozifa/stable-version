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
                @auth
                    <a href="{{ route('profile.edit') }}">My Profile</a>
                @else
                    <a href="{{ route('user.login.form') }}">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="site-container">
        @yield('content')
    </main>
</body>
</html>
