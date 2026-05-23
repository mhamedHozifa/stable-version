<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Customizable Store | Fashion & Electronics</title>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <!-- Main stylesheet (dark blue / light white theme) -->
    <link rel="stylesheet" href="{{ asset('css/ele.css') }}">
</head>
<body>

<!-- TRANSPARENT HEADER (Categories, Clothes for men, Clothes for woman) -->
<header class="transparent-header">
    <div class="header-container">
        <div class="logo-area">
            <h2 class="store-logo">Customizable Store</h2>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="#">Categories</a></li>
                <li><a href="#">Clothes for men</a></li>
                <li><a href="#">Clothes for woman</a></li>
            </ul>
        </nav>
        <div class="header-actions">
            <i class="fas fa-search"></i>
            <i class="fas fa-shopping-bag"></i>
        </div>
    </div>
</header>

<main class="container">
    <!-- Hero / Our Products section -->
    <div class="hero-section">
        <h1 class="hero-title">Our Products</h1>
        <p class="hero-subtitle">Browse what is currently available in our catalog.</p>
    </div>

    <!-- Products Grid - 12 items -->
    <div class="products-grid">
        @php
            $products = [
                ['name' => 'corrupti quisquam laboris!', 'price' => 262.79],
                ['name' => 'suscipit temporibus accusamus', 'price' => 381.43],
                ['name' => 'nihil qui voluptas', 'price' => 72.31],
                ['name' => 'perspiciatis repellat et', 'price' => 48.24],
                ['name' => 'qui impedit tenetur', 'price' => 457.98],
                ['name' => 'quo error error', 'price' => 609.43],
                ['name' => 'voluptas blanditiis et', 'price' => 153.27],
                ['name' => 'in rerum voluptatem', 'price' => 275.51],
                ['name' => 'dolorum sint vitae', 'price' => 129.99],
                ['name' => 'odio facere velit', 'price' => 89.50],
                ['name' => 'labore consequatur est', 'price' => 349.99],
                ['name' => 'ipsam voluptatem quia', 'price' => 199.00],
            ];
        @endphp

        @foreach($products as $index => $product)
            <div class="product-card" data-id="{{ $index }}">
                <div class="product-media">
                    <i class="fas fa-microchip"></i>
                </div>
                <h3 class="product-name">{{ $product['name'] }}</h3>
                <div class="product-price">${{ number_format($product['price'], 2) }}</div>
                <div class="product-actions">
                    <div class="qty-control">
                        <label for="qty-{{ $index }}" class="visually-hidden">Quantity</label>
                        <input type="number" id="qty-{{ $index }}" class="qty-input" value="1" min="1" step="1">
                    </div>
                    <button class="btn-add-to-cart" data-product-name="{{ $product['name'] }}">
                        <i class="fas fa-cart-shopping"></i> Add to Cart
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination-section">
        <div class="results-info">Showing 1 to 12 of 50 results</div>
        <div class="pagination-controls">
            <a href="#" class="pagination-link prev-next">« Previous</a>
            <a href="#" class="pagination-link active">1</a>
            <a href="#" class="pagination-link">2</a>
            <a href="#" class="pagination-link">3</a>
            <a href="#" class="pagination-link">4</a>
            <a href="#" class="pagination-link">5</a>
            <a href="#" class="pagination-link prev-next">Next »</a>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addButtons = document.querySelectorAll('.btn-add-to-cart');
        addButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const productCard = this.closest('.product-card');
                const productName = this.getAttribute('data-product-name');
                const qtyField = productCard.querySelector('.qty-input');
                let quantity = parseInt(qtyField.value);
                if (isNaN(quantity) || quantity < 1) quantity = 1;
                alert(`🛒 Added ${quantity} × "${productName}" to your cart.`);
            });
        });

        const paginationLinks = document.querySelectorAll('.pagination-link');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if(!this.classList.contains('active')) {
                    alert('Pagination demo: page change would occur here.');
                }
            });
        });
    });
</script>
</body>
</html>