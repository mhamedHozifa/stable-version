<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velvet & Moss Boutique</title>
    
    <!-- Link to the CSS file (will be provided next) -->
    <link rel="stylesheet" href="{{ asset('css/cloth.css') }}">
    
    <!-- Font for a clean look (Google Fonts) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Header / Navbar -->
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
                    Cart <span class="cart-badge">2</span>
                </a>
                <a href="#" class="nav-link">
                    My Profile 
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <h2 class="hero-title">Spring '24 Collection</h2>
            <p class="hero-subtitle">Explore our curated essentials.</p>
        </section>

        <!-- Product Grid -->
        <section class="product-grid-wrapper">
            <div class="product-grid">
                
                <!-- Card 1 -->
                <div class="product-card">
                    <div class="card-info">
                        <h3 class="product-name">Linen Shirt</h3>
                        <p class="product-price">$262.79</p>
                        <div class="card-actions">
                            <input type="number" class="qty-input" value="1" min="1">
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                    <div class="card-image">
                        <!-- Place Product Image Here -->
                        <img src="https://placehold.co/150x200/transparent/4a3b2b?text=Product+Pic" alt="Linen Shirt" class="product-img">
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="product-card">
                    <div class="card-info">
                        <h3 class="product-name">Chino Trousers</h3>
                        <p class="product-price">$381.43</p>
                        <div class="card-actions">
                            <input type="number" class="qty-input" value="1" min="1">
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                    <div class="card-image">
                        <!-- Place Product Image Here -->
                        <img src="https://placehold.co/150x200/transparent/4a3b2b?text=Product+Pic" alt="Chino Trousers" class="product-img">
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="product-card">
                    <div class="card-info">
                        <h3 class="product-name">Crewneck Sweater</h3>
                        <p class="product-price">$72.31</p>
                        <div class="card-actions">
                            <input type="number" class="qty-input" value="1" min="1">
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                    <div class="card-image">
                        <!-- Place Product Image Here -->
                        <img src="https://placehold.co/150x200/transparent/4a3b2b?text=Product+Pic" alt="Crewneck Sweater" class="product-img">
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="product-card">
                    <div class="card-info">
                        <h3 class="product-name">Work Jacket</h3>
                        <p class="product-price">$48.24</p>
                        <div class="card-actions">
                            <input type="number" class="qty-input" value="1" min="1">
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                    <div class="card-image">
                        <!-- Place Product Image Here -->
                        <img src="https://placehold.co/150x200/transparent/4a3b2b?text=Product+Pic" alt="Work Jacket" class="product-img">
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="product-card">
                    <div class="card-info">
                        <h3 class="product-name">Striped Tee</h3>
                        <p class="product-price">$457.98</p>
                        <div class="card-actions">
                            <input type="number" class="qty-input" value="1" min="1">
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                    <div class="card-image">
                        <!-- Place Product Image Here -->
                        <img src="https://placehold.co/150x200/transparent/4a3b2b?text=Product+Pic" alt="Striped Tee" class="product-img">
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="product-card">
                    <div class="card-info">
                        <h3 class="product-name">Leather Sneakers</h3>
                        <p class="product-price">$609.43</p>
                        <div class="card-actions">
                            <input type="number" class="qty-input" value="1" min="1">
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                    <div class="card-image">
                        <!-- Place Product Image Here -->
                        <img src="https://placehold.co/150x200/transparent/4a3b2b?text=Product+Pic" alt="Leather Sneakers" class="product-img">
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="product-card">
                    <div class="card-info">
                        <h3 class="product-name">Leather Belt</h3>
                        <p class="product-price">$153.27</p>
                        <div class="card-actions">
                            <input type="number" class="qty-input" value="1" min="1">
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                    <div class="card-image">
                        <!-- Place Product Image Here -->
                        <img src="https://placehold.co/150x200/transparent/4a3b2b?text=Product+Pic" alt="Leather Belt" class="product-img">
                    </div>
                </div>

                <!-- Card 8 -->
                <div class="product-card">
                    <div class="card-info">
                        <h3 class="product-name">Field Watch</h3>
                        <p class="product-price">$275.51</p>
                        <div class="card-actions">
                            <input type="number" class="qty-input" value="1" min="1">
                            <button class="add-btn">Add to Cart</button>
                        </div>
                    </div>
                    <div class="card-image">
                        <!-- Place Product Image Here -->
                        <img src="https://placehold.co/150x200/transparent/4a3b2b?text=Product+Pic" alt="Field Watch" class="product-img">
                    </div>
                </div>

            </div>
        </section>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            <p class="results-text">Showing 1 to 12 of 50 results</p>
            <div class="pagination-controls">
                <a href="#" class="pagination-link">&#171; Previous</a>
                <a href="#" class="pagination-link">Next &#187;</a>
            </div>
            <div class="pagination-numbers">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">5</button>
                <button class="page-btn arrow-btn">&#8250;</button>
            </div>
        </div>
    </main>

</body>
</html>