<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velvet & Moss Boutique – Secure Checkout</title>

    <!-- Base Styles (reusing cloth.css for global & navbar styling) -->
    <link rel="stylesheet" href="{{ asset('css/cloth.css') }}">
    <!-- Additional checkout-specific styles (to be provided next) -->
    <link rel="stylesheet" href="{{ asset('css/clothCheckout.css') }}">

    <!-- Google Fonts: Inter (matching original store) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- ========== HEADER / NAVBAR (identical style to clothStore) ========== -->
    <header class="navbar">
        <div class="nav-container">
            <div class="nav-left">
                <h1 class="brand-logo">Velvet & Moss Boutique</h1>
            </div>

            <div class="nav-center">
                <div class="dropdown-wrapper">
                    <span class="dropdown-trigger">Categories <span class="arrow">&#8964;</span></span>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Clothes for men
                        </a>
                        <a href="#" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Clothes for women
                        </a>
                    </div>
                </div>
            </div>

            <div class="nav-right">
                <a href="#" class="nav-link">Products</a>
                <a href="#" class="nav-link cart-icon">
                    Cart <span class="cart-badge">2</span>
                </a>
                <a href="#" class="nav-link">
                    My Profile
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- ========== MAIN CHECKOUT CONTENT ========== -->
    <main class="main-content">
        <!-- Hero Section (soft intro, same style as store) -->
        <section class="hero-section">
            <h2 class="hero-title">Checkout</h2>
            <p class="hero-subtitle">Complete your purchase with ease.</p>
        </section>

        <!-- Checkout Grid: Two columns (Order Summary + Billing form) -->
        <div class="checkout-wrapper">
            <div class="checkout-grid">
                <!-- LEFT COLUMN: Billing details form -->
                <div class="billing-card">
                    <h3 class="checkout-section-title">Billing Details</h3>
                    <form action="#" method="POST" class="billing-form">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Full name</label>
                            <input type="text" id="name" name="name" placeholder="John Doe" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" placeholder="Street, P.O. Box" required>
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
                                <label for="zip">Zip / Postal code</label>
                                <input type="text" id="zip" name="zip" placeholder="10001" required>
                            </div>
                            <div class="form-group half">
                                <label for="country">Country</label>
                                <select id="country" name="country" required>
                                    <option value="" disabled selected>Select country</option>
                                    <option value="US">United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="AU">Australia</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="pay-now-btn">ادفع الآن</button>
                    </form>
                </div>

                <!-- RIGHT COLUMN: Order Summary (cart items & totals) -->
                <div class="summary-card">
                    <h3 class="checkout-section-title">Order Summary</h3>
                    <div class="order-summary-table-wrapper">
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
                                <!-- Sample product row (exactly as described in checkout prompt) -->
                                <tr>
                                    <td class="product-name-cell">quia molestiae quae</td>
                                    <td>$331.92</td>
                                    <td>1</td>
                                    <td>$331.92</td>
                                </tr>
                                <!-- you can add more dynamic rows if needed -->
                            </tbody>
                            <tfoot>
                                <tr class="subtotal-row">
                                    <td colspan="3" class="total-label">Subtotal</td>
                                    <td class="total-amount">$331.92</td>
                                </tr>
                                <tr class="shipping-row">
                                    <td colspan="3" class="total-label">Shipping</td>
                                    <td class="total-amount">Calculated at next step</td>
                                </tr>
                                <tr class="grandtotal-row">
                                    <td colspan="3" class="total-label grandtotal-label">Total</td>
                                    <td class="total-amount grandtotal-amount">$331.92</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <p class="summary-note">Taxes and shipping fees will be finalized before payment.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- subtle footer (optional, keeps warm tone) -->
    <footer style="text-align: center; padding: 2rem 1rem; color: #9b8e7c; font-size: 0.8rem; border-top: 1px solid #eae3d4; margin-top: 2rem;">
        <p>© Velvet & Moss Boutique — tailored with care</p>
    </footer>
</body>
</html>