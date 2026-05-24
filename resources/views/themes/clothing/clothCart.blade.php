<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Your Cart | Velvet & Moss Boutique</title>
    <link rel="stylesheet" href="{{ asset('css/themes/clothing/clothCart.css') }}">
    <!-- SINGLE CSS FILE (includes navbar + cart styles) -->
    <link rel="stylesheet" href="{{ asset('css/clothCart.css') }}">
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- ==================== NAVBAR (EXACT MATCH TO MAIN SITE) ==================== -->
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
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            Clothes for men
                        </a>
                        <a href="#" class="dropdown-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            Clothes for women
                        </a>
                    </div>
                </div>
            </div>

            <div class="nav-right">
                <a href="#" class="nav-link">Products</a>
                <a href="#" class="nav-link cart-icon">
                    Cart <span class="cart-badge" id="cartItemCount">2</span>
                </a>
                <a href="#" class="nav-link">
                    My Profile 
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </a>
            </div>
        </div>
    </header>

    <!-- ==================== MAIN CART CONTENT ==================== -->
    <main class="cart-main">
        <div class="cart-container">
            <div class="cart-header-title">
                <h2 class="cart-title">Shopping Cart</h2>
                <p class="cart-subtitle">Review and adjust the items in your bag</p>
            </div>

            <div class="cart-items-wrapper" id="cartItemsWrapper">
                <!-- CART HEADER -->
                <div class="cart-grid-header">
                    <div class="col-product">Product</div>
                    <div class="col-price">Price</div>
                    <div class="col-qty">Quantity</div>
                    <div class="col-subtotal">Subtotal</div>
                    <div class="col-actions">Actions</div>
                </div>

                <!-- ITEM 1 (quia molestiae quae) -->
                <div class="cart-item" data-id="item1" data-price="331.92">
                    <div class="cart-item-product">
                        <div class="cart-item-image">
                            <img src="https://placehold.co/100x130/transparent/4a3b2b?text=Quia+Style" alt="quia molestiae quae" class="cart-product-img">
                        </div>
                        <div class="cart-item-info">
                            <h3 class="cart-product-name">quia molestiae quae</h3>
                            <p class="cart-product-description">Commodi nihil delectus ipsa consequatur explicabo architecto eveniet. Non recusandae sit rerum earum et et. Quod rerum et reprehenderit totam impedit provident.</p>
                        </div>
                    </div>
                    <div class="cart-item-price">$331.92</div>
                    <div class="cart-item-qty">
                        <input type="number" class="cart-qty-input" value="1" min="1" step="1">
                        <button class="btn-update-qty">Update</button>
                    </div>
                    <div class="cart-item-subtotal">$331.92</div>
                    <div class="cart-item-actions">
                        <button class="btn-remove-item">Remove</button>
                    </div>
                </div>

                <!-- ITEM 2 (accusamus vel similique) -->
                <div class="cart-item" data-id="item2" data-price="122.31">
                    <div class="cart-item-product">
                        <div class="cart-item-image">
                            <img src="https://placehold.co/100x130/transparent/4a3b2b?text=Accusamus+Vel" alt="accusamus vel similique" class="cart-product-img">
                        </div>
                        <div class="cart-item-info">
                            <h3 class="cart-product-name">accusamus vel similique</h3>
                            <p class="cart-product-description">Nihil voluptatem tempora magni sint praesentium quod esse. Eaque tempora voluptatem officia et voluptas illo autem voluptatem. Aliquid sunt provident voluptatem ad earum eligendi qui. Non dolor deleniti inventore.</p>
                        </div>
                    </div>
                    <div class="cart-item-price">$122.31</div>
                    <div class="cart-item-qty">
                        <input type="number" class="cart-qty-input" value="1" min="1" step="1">
                        <button class="btn-update-qty">Update</button>
                    </div>
                    <div class="cart-item-subtotal">$122.31</div>
                    <div class="cart-item-actions">
                        <button class="btn-remove-item">Remove</button>
                    </div>
                </div>

                <!-- EMPTY CART MESSAGE (hidden initially) -->
                <div class="empty-cart-message" id="emptyCartMsg" style="display: none;">
                    <p>Your cart is currently empty.</p>
                    <a href="#" class="continue-shopping-link">← Continue Shopping</a>
                </div>
            </div>

            <!-- CART SUMMARY + ACTIONS -->
            <div class="cart-summary-actions">
                <div class="cart-buttons-group">
                    <a href="#" class="btn-secondary continue-shopping">Continue Shopping</a>
                    <button class="btn-secondary clear-cart" id="clearCartBtn">Clear Cart</button>
                </div>
                <div class="cart-total-box">
                    <div class="total-label">Total:</div>
                    <div class="total-amount" id="cartTotalAmount">$454.23</div>
                </div>
            </div>

            <div class="checkout-action">
                <button class="btn-primary-checkout" id="checkoutBtn">Proceed to Checkout →</button>
            </div>
        </div>
    </main>

    <!-- CART JAVASCRIPT (same interactive functionality) -->
    <script>
        (function() {
            function formatUSD(value) {
                return '$' + value.toFixed(2);
            }

            function updateCartTotal() {
                const cartItems = document.querySelectorAll('.cart-item');
                let total = 0;
                cartItems.forEach(item => {
                    const subtotalElem = item.querySelector('.cart-item-subtotal');
                    if (subtotalElem) {
                        let subtotalValue = parseFloat(subtotalElem.innerText.replace('$', ''));
                        if (!isNaN(subtotalValue)) total += subtotalValue;
                    }
                });
                const totalElement = document.getElementById('cartTotalAmount');
                if (totalElement) totalElement.innerText = formatUSD(total);
                return total;
            }

            function updateCartBadge() {
                const cartItems = document.querySelectorAll('.cart-item');
                const itemCount = cartItems.length;
                const badge = document.getElementById('cartItemCount');
                if (badge) badge.innerText = itemCount;
                return itemCount;
            }

            function updateItemSubtotal(itemRow) {
                const priceElem = itemRow.querySelector('.cart-item-price');
                const qtyInput = itemRow.querySelector('.cart-qty-input');
                const subtotalElem = itemRow.querySelector('.cart-item-subtotal');
                if (!priceElem || !qtyInput || !subtotalElem) return;
                let price = parseFloat(priceElem.innerText.replace('$', ''));
                let quantity = parseInt(qtyInput.value, 10);
                if (isNaN(quantity) || quantity < 1) quantity = 1;
                qtyInput.value = quantity;
                const newSubtotal = price * quantity;
                subtotalElem.innerText = formatUSD(newSubtotal);
                updateCartTotal();
                updateCartBadge();
            }

            function removeCartItem(buttonElement) {
                const cartItem = buttonElement.closest('.cart-item');
                if (!cartItem) return;
                cartItem.remove();
                const remainingItems = document.querySelectorAll('.cart-item');
                const emptyMsg = document.getElementById('emptyCartMsg');
                const cartHeader = document.querySelector('.cart-grid-header');
                if (remainingItems.length === 0) {
                    if (emptyMsg) emptyMsg.style.display = 'block';
                    if (cartHeader) cartHeader.style.display = 'none';
                    const totalElement = document.getElementById('cartTotalAmount');
                    if (totalElement) totalElement.innerText = '$0.00';
                } else {
                    if (emptyMsg) emptyMsg.style.display = 'none';
                    if (cartHeader) cartHeader.style.display = 'grid';
                    updateCartTotal();
                }
                updateCartBadge();
            }

            function clearAllCartItems() {
                const allItems = document.querySelectorAll('.cart-item');
                allItems.forEach(item => item.remove());
                const emptyMsg = document.getElementById('emptyCartMsg');
                const cartHeader = document.querySelector('.cart-grid-header');
                if (emptyMsg) emptyMsg.style.display = 'block';
                if (cartHeader) cartHeader.style.display = 'none';
                const totalElement = document.getElementById('cartTotalAmount');
                if (totalElement) totalElement.innerText = '$0.00';
                updateCartBadge();
            }

            function bindCartEvents() {
                document.querySelectorAll('.btn-update-qty').forEach(btn => {
                    btn.removeEventListener('click', handleUpdateClick);
                    btn.addEventListener('click', handleUpdateClick);
                });
                document.querySelectorAll('.btn-remove-item').forEach(btn => {
                    btn.removeEventListener('click', handleRemoveClick);
                    btn.addEventListener('click', handleRemoveClick);
                });
            }

            function handleUpdateClick(e) {
                const btn = e.currentTarget;
                const cartItem = btn.closest('.cart-item');
                if (cartItem) updateItemSubtotal(cartItem);
            }

            function handleRemoveClick(e) {
                const btn = e.currentTarget;
                removeCartItem(btn);
                bindCartEvents();
            }

            function initializeCart() {
                document.querySelectorAll('.cart-item').forEach(item => {
                    updateItemSubtotal(item);
                });
                bindCartEvents();
                const itemsExist = document.querySelectorAll('.cart-item').length;
                const emptyMsg = document.getElementById('emptyCartMsg');
                const cartHeader = document.querySelector('.cart-grid-header');
                if (itemsExist === 0) {
                    if (emptyMsg) emptyMsg.style.display = 'block';
                    if (cartHeader) cartHeader.style.display = 'none';
                } else {
                    if (emptyMsg) emptyMsg.style.display = 'none';
                    if (cartHeader) cartHeader.style.display = 'grid';
                }
                updateCartTotal();
                updateCartBadge();
            }

            const clearBtn = document.getElementById('clearCartBtn');
            if (clearBtn) {
                clearBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to clear your entire cart?')) {
                        clearAllCartItems();
                        bindCartEvents();
                    }
                });
            }

            const checkoutBtn = document.getElementById('checkoutBtn');
            if (checkoutBtn) {
                checkoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const cartItemsCount = document.querySelectorAll('.cart-item').length;
                    if (cartItemsCount === 0) {
                        alert('Your cart is empty. Add some beautiful pieces before checkout!');
                    } else {
                        alert('✨ Proceeding to checkout — this is a demo experience. ✨\nThank you for shopping at Velvet & Moss Boutique.');
                    }
                });
            }

            const continueLinks = document.querySelectorAll('.continue-shopping, .continue-shopping-link');
            continueLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('Navigate to product catalog (demo interaction). In production, you would be redirected to /products');
                });
            });

            initializeCart();
        })();
    </script>
</body>
</html>