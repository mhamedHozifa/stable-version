<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Checkout | Customizable Store</title>
    <link rel="stylesheet" href="{{ asset('css/themes/electronics/eleCheckout.css') }}">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <!-- Checkout CSS (same style as store theme) -->
    <link rel="stylesheet" href="{{ asset('css/eleCheckout.css') }}">
</head>
<body>

<!-- TRANSPARENT HEADER (exactly same as eleStore) -->
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
    <!-- Checkout Header / Hero -->
    <div class="hero-section">
        <h1 class="hero-title">Checkout</h1>
        <p class="hero-subtitle">Review your items and complete your purchase securely.</p>
    </div>

    @php
        // Simulated cart items for the checkout summary
        $cartItems = [
            ['name' => 'quia molestiae quae', 'price' => 331.92, 'quantity' => 1],
            ['name' => 'voluptas blanditiis et', 'price' => 153.27, 'quantity' => 2],
            ['name' => 'nihil qui voluptas', 'price' => 72.31, 'quantity' => 1],
        ];
        $subtotal = 0;
        foreach($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shipping = 12.50;
        $tax = round($subtotal * 0.08, 2);
        $grandTotal = $subtotal + $shipping + $tax;
    @endphp

    <!-- Two Column Checkout Layout -->
    <div class="checkout-layout">
        <!-- Billing Details Form (Left Column) -->
        <div class="billing-card">
            <h3 class="card-title"><i class="fas fa-user-edit"></i> Billing Details</h3>
            <form id="checkout-form" action="#" method="post">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label for="address">Street Address</label>
                    <input type="text" id="address" name="address" placeholder="123 Main St" required>
                </div>
                <div class="form-row">
                    <div class="form-group half">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="New York" required>
                    </div>
                    <div class="form-group half">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" placeholder="NY" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group half">
                        <label for="zip">Zip Code</label>
                        <input type="text" id="zip" name="zip" placeholder="10001" required>
                    </div>
                    <div class="form-group half">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country" placeholder="United States" required>
                    </div>
                </div>
                <button type="submit" class="btn-pay-now"><i class="fas fa-lock"></i> ادفع الآن</button>
            </form>
        </div>

        <!-- Order Summary Card (Right Column) -->
        <div class="order-summary-card">
            <h3 class="card-title"><i class="fas fa-receipt"></i> Order Summary</h3>
            <div class="summary-table-wrapper">
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td class="product-name-cell">{{ $item['name'] }}</td>
                            <td class="price-cell">${{ number_format($item['price'], 2) }}</td>
                            <td class="qty-cell">{{ $item['quantity'] }}</td>
                            <td class="subtotal-cell">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="subtotal-row">
                            <td colspan="3">Subtotal</td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                        </tr>
                        <tr class="shipping-row">
                            <td colspan="3">Shipping</td>
                            <td>${{ number_format($shipping, 2) }}</td>
                        </tr>
                        <tr class="tax-row">
                            <td colspan="3">Tax (8%)</td>
                            <td>${{ number_format($tax, 2) }}</td>
                        </tr>
                        <tr class="total-row">
                            <td colspan="3">Total</td>
                            <td class="grand-total">${{ number_format($grandTotal, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <p class="secure-notice"><i class="fas fa-shield-alt"></i> Secure transaction — encrypted and safe</p>
        </div>
    </div>
</main>

<!-- Optional small footer (clean) -->
<footer class="checkout-footer">
    <p>© Customizable Store — All rights reserved.</p>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle payment button click (demo)
        const payButton = document.querySelector('.btn-pay-now');
        if (payButton) {
            payButton.addEventListener('click', function(e) {
                e.preventDefault();
                // Basic demo validation alert
                alert('✨ Demo checkout: your order would be processed. ✨\nTotal: ${{ number_format($grandTotal, 2) }}');
            });
        }

        // Optional: interactive header icons (demo)
        const searchIcon = document.querySelector('.header-actions .fa-search');
        const bagIcon = document.querySelector('.header-actions .fa-shopping-bag');
        if(searchIcon) searchIcon.addEventListener('click', () => alert('🔍 Search feature (demo)'));
        if(bagIcon) bagIcon.addEventListener('click', () => alert('🛒 View cart (demo)'));
    });
</script>
</body>
</html>