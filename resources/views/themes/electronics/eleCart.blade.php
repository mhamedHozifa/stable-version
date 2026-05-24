<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Customizable Store - Shopping Cart</title>
    <link rel="stylesheet" href="{{ asset('css/themes/electronics/eleCart.css') }}">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <!-- Main theme (dark blue / light white) - includes transparent navbar styles -->
    <link rel="stylesheet" href="{{ asset('css/ele.css') }}">
    <!-- Cart specific styles (will be provided after "next") -->
    <link rel="stylesheet" href="{{ asset('css/eleCart.css') }}">
</head>
<body>

<!-- TRANSPARENT HEADER (exactly as in main store, with categories) -->
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
    <!-- Hero / Cart title -->
    <div class="hero-section">
        <h1 class="hero-title">Shopping Cart</h1>
        <p class="hero-subtitle">Review your items and proceed to checkout.</p>
    </div>

    @php
        $cartItems = [
            [
                'id'          => 1,
                'name'        => 'quia molestiae quae',
                'description' => 'Commodi nihil delectus ipsa consequatur explicabo architecto eveniet. Non recusandae sit rerum earum et et. Quod rerum et reprehenderit totam impedit provident.',
                'price'       => 331.92,
                'qty'         => 1,
            ],
            [
                'id'          => 2,
                'name'        => 'accusamus vel similique',
                'description' => 'Nihil voluptatem tempora magni sint praesentium quod esse. Eaque tempora voluptatem officia et voluptas illo autem voluptatem. Aliquid sunt provident voluptatem ad earum eligendi qui. Non dolor deleniti inventore.',
                'price'       => 122.31,
                'qty'         => 1,
            ],
        ];
    @endphp

    <!-- Cart wrapper with dynamic items -->
    <div class="cart-wrapper">
        <!-- column headers (hidden on small screens via css) -->
        <div class="cart-header">
            <span>Product</span>
            <span>Price</span>
            <span>Quantity</span>
            <span>Subtotal</span>
            <span>Actions</span>
        </div>

        <div class="cart-items-list" id="cartItemsList">
            @foreach($cartItems as $item)
                <div class="cart-item" data-id="{{ $item['id'] }}" data-price="{{ $item['price'] }}">
                    <div class="cart-item-product">
                        <div class="product-media small-media">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <div class="cart-item-info">
                            <h4 class="product-name">{{ $item['name'] }}</h4>
                            <p class="item-description">{{ $item['description'] }}</p>
                        </div>
                    </div>
                    <div class="cart-item-price">${{ number_format($item['price'], 2) }}</div>
                    <div class="cart-item-quantity">
                        <input type="number" class="qty-input item-qty" value="{{ $item['qty'] }}" min="1" step="1">
                    </div>
                    <div class="cart-item-subtotal" data-subtotal="{{ $item['price'] * $item['qty'] }}">
                        ${{ number_format($item['price'] * $item['qty'], 2) }}
                    </div>
                    <div class="cart-item-actions">
                        <button class="btn-update btn-sm-cart" title="Update quantity">
                            <i class="fas fa-pen"></i> Update
                        </button>
                        <button class="btn-remove btn-sm-cart" title="Remove item">
                            <i class="fas fa-trash-alt"></i> Remove
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty cart message (hidden initially) -->
        <div id="emptyCartMessage" class="empty-cart-message" style="display: none;">
            <i class="fas fa-shopping-cart"></i>
            <p>Your cart is empty.</p>
            <a href="{{ url('/') }}" class="btn-add-to-cart" style="display: inline-flex; margin-top: 1rem;">Continue Shopping</a>
        </div>

        <!-- Cart summary & actions -->
        <div class="cart-footer">
            <div class="cart-total-wrapper">
                <span class="total-label">Total:</span>
                <span class="total-amount" id="cartTotal">$454.23</span>
            </div>
            <div class="cart-actions-group">
                <a href="#" class="btn-outline-cart" id="continueShoppingBtn">Continue Shopping</a>
                <button class="btn-outline-cart" id="clearCartBtn">Clear Cart</button>
                <button class="btn-primary-cart" id="checkoutBtn">Proceed to Checkout</button>
            </div>
        </div>
    </div>
</main>

<script>
    (function() {
        // Helper: update the whole cart total based on current subtotals
        function updateCartTotal() {
            const subtotalSpans = document.querySelectorAll('.cart-item-subtotal');
            let total = 0;
            subtotalSpans.forEach(span => {
                let value = parseFloat(span.innerText.replace('$', '').replace(',', ''));
                if (!isNaN(value)) total += value;
            });
            const totalEl = document.getElementById('cartTotal');
            if (totalEl) totalEl.innerText = '$' + total.toFixed(2);
            return total;
        }

        // Show/hide empty cart UI
        function toggleEmptyCart() {
            const itemsList = document.getElementById('cartItemsList');
            const emptyMsg = document.getElementById('emptyCartMessage');
            const cartFooter = document.querySelector('.cart-footer');
            const cartHeader = document.querySelector('.cart-header');
            const hasItems = itemsList && itemsList.children.length > 0;

            if (!hasItems) {
                if (emptyMsg) emptyMsg.style.display = 'flex';
                if (cartFooter) cartFooter.style.display = 'none';
                if (cartHeader) cartHeader.style.display = 'none';
            } else {
                if (emptyMsg) emptyMsg.style.display = 'none';
                if (cartFooter) cartFooter.style.display = 'flex';
                if (cartHeader) cartHeader.style.display = 'grid';
            }
        }

        // Remove specific cart item row
        function removeCartItem(button) {
            const cartItem = button.closest('.cart-item');
            if (!cartItem) return;
            cartItem.remove();
            updateCartTotal();
            toggleEmptyCart();
        }

        // Update single row subtotal based on quantity & stored price
        function updateRowSubtotal(cartItem) {
            const price = parseFloat(cartItem.getAttribute('data-price'));
            const qtyInput = cartItem.querySelector('.item-qty');
            let quantity = parseInt(qtyInput.value);
            if (isNaN(quantity) || quantity < 1) {
                quantity = 1;
                qtyInput.value = 1;
            }
            const newSubtotal = price * quantity;
            const subtotalSpan = cartItem.querySelector('.cart-item-subtotal');
            if (subtotalSpan) {
                subtotalSpan.innerText = '$' + newSubtotal.toFixed(2);
                subtotalSpan.setAttribute('data-subtotal', newSubtotal);
            }
            updateCartTotal();
        }

        // Event delegation: handle Update and Remove clicks inside cart items list
        const itemsContainer = document.getElementById('cartItemsList');
        if (itemsContainer) {
            itemsContainer.addEventListener('click', function(e) {
                const target = e.target.closest('.btn-update');
                if (target) {
                    e.preventDefault();
                    const cartItem = target.closest('.cart-item');
                    if (cartItem) updateRowSubtotal(cartItem);
                    return;
                }

                const removeTarget = e.target.closest('.btn-remove');
                if (removeTarget) {
                    e.preventDefault();
                    removeCartItem(removeTarget);
                }
            });
        }

        // Clear entire cart
        const clearBtn = document.getElementById('clearCartBtn');
        if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const itemsList = document.getElementById('cartItemsList');
                if (itemsList) {
                    while (itemsList.firstChild) {
                        itemsList.removeChild(itemsList.firstChild);
                    }
                }
                updateCartTotal();
                toggleEmptyCart();
            });
        }

        // Proceed to Checkout (demo)
        const checkoutBtn = document.getElementById('checkoutBtn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', function() {
                alert('🚀 Proceeding to checkout. (Demo integration)');
            });
        }

        // Continue Shopping link (simple navigation demo)
        const continueBtn = document.getElementById('continueShoppingBtn');
        if (continueBtn) {
            continueBtn.addEventListener('click', function(e) {
                e.preventDefault();
                alert('✨ Continue shopping – browse more products!');
                // In real scenario: window.location.href = "/shop";
            });
        }

        // Additional initial check: ensure total matches and empty state is correct
        updateCartTotal();
        toggleEmptyCart();
    })();
</script>
</body>
</html>