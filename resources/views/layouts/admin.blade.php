<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
            <ul class="nav">
                <li><a href="/admin">Dashboard</a></li>
                <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a></li>
                <li><a href="/admin/categories">Categories</a></li>
                <li><a href="/admin/orders">Orders</a></li>
                <li><a href="/admin/customers">Customers</a></li>
                <li><a href="/admin/settings">Settings</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="top-bar">
                <div class="user-info">
                    <span>Welcome, Admin</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="background:none; border:none; color:blue; text-decoration:underline; cursor:pointer;">
                        Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- محتوى الصفحة المتغير -->
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/admin-products.js') }}"></script>
    @stack('scripts')
</body>
</html>