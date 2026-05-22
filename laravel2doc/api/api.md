# API Documentation

## Project: laravel/laravel

Laravel Version: v12.53.0

Generated: ١٩‏/٥‏/٢٠٢٦، ٧:٢٠:١٨ م

## Table of Contents

- [web](#web)

## web

| Method | Endpoint | Handler | Description |
|--------|----------|---------|-------------|
| GET | /admin/login | AdminLoginController::class, 'create' | List login |
| POST | /admin/login | AdminLoginController::class, 'store' | Create a new login |
| GET | / | function () {
            return view('admin.dashboard', [
                'productsCount' => Product::count(),
                'categoriesCount' => Category::count(),
                'featuredCount' => Product::where('is_featured', true)->count(),
                'lowStockCount' => Product::where('stock', '<=', 5)->count(),
             | List resource |
| GET | /products/{product}/edit-data | App\Http\Controllers\Admin\ProductController::class, 'editData' | Retrieve a specific edit-data |
| GET | /categories/{category}/edit-data | App\Http\Controllers\Admin\CategoryController::class, 'editData' | Retrieve a specific edit-data |
| GET | /settings | App\Http\Controllers\Admin\SettingsController::class, 'edit' | List settings |
| PATCH | /settings | App\Http\Controllers\Admin\SettingsController::class, 'update' | Update a specific settings |
| POST | /logout | AdminLoginController::class, 'logout' | Create a new logout |
| GET | /orders | OrderController::class, 'index' | List orders |
| GET | /orders/{order} | OrderController::class, 'show' | Retrieve a specific {order} |
| POST | /orders/{order}/status | OrderController::class, 'updateStatus' | Create a new status |
| POST | /orders/{order}/refund | OrderController::class, 'refund' | Create a new refund |
| GET | /orders/{order}/packing-slip | OrderController::class, 'packingSlip' | Retrieve a specific packing-slip |
| GET | /register | AuthController::class, 'showRegisterForm' | List register |
| POST | /register | AuthController::class, 'register' | Create a new register |
| GET | / | AuthController::class, 'showLoginForm' | List resource |
| GET | /login | AuthController::class, 'showLoginForm' | List login |
| POST | / | AuthController::class, 'login' | Create a new resource |
| POST | /logout | AuthController::class, 'logout' | Create a new logout |
| GET | /forgot-password | AuthController::class, 'showForgotForm' | List forgot-password |
| POST | /forgot-password | AuthController::class, 'sendResetLink' | Create a new forgot-password |
| GET | /reset-password/{token} | AuthController::class, 'showResetForm' | Retrieve a specific {token} |
| POST | /reset-password | AuthController::class, 'reset' | Create a new reset-password |
| GET | /logout-form | AuthController::class, 'showLogoutForm' | List logout-form |
| GET | /profile | ProfileController::class, 'edit' | List profile |
| PATCH | /profile | ProfileController::class, 'update' | Update a specific profile |
| GET | /products | ProductController::class, 'publicIndex' | List products |
| GET | /products/{product} | ProductController::class, 'publicShow' | Retrieve a specific {product} |
| POST | /cart/add/{product} | CartController::class, 'add' | Create a new {product} |
| GET | /cart | CartController::class, 'index' | List cart |
| PATCH | /cart/update/{product} | CartController::class, 'update' | Update a specific {product} |
| DELETE | /cart/remove/{product} | CartController::class, 'remove' | Delete a specific {product} |
| POST | /cart/clear | CartController::class, 'clear' | Create a new clear |
| GET | /cart/checkout | CartController::class, 'checkout' | List checkout |
| POST | /cart/checkout | CartController::class, 'processCheckout' | Create a new checkout |
| POST | /checkout/process | CheckoutController::class, 'processCheckout' | Create a new process |
| GET | /checkout/success | CheckoutController::class, 'success' | List success |
| GET | /checkout/cancel | CheckoutController::class, 'cancel' | List cancel |
| GET | /products/{product} | ProductController::class, 'publicShow' | Retrieve a specific {product} |

### GET /admin/login

**Handler:** AdminLoginController::class, 'create'

**Description:** List login

---

### POST /admin/login

**Handler:** AdminLoginController::class, 'store'

**Description:** Create a new login

---

### GET /

**Handler:** function () {
            return view('admin.dashboard', [
                'productsCount' => Product::count(),
                'categoriesCount' => Category::count(),
                'featuredCount' => Product::where('is_featured', true)->count(),
                'lowStockCount' => Product::where('stock', '<=', 5)->count(),
            

**Description:** List resource

---

### GET /products/{product}/edit-data

**Handler:** App\Http\Controllers\Admin\ProductController::class, 'editData'

**Description:** Retrieve a specific edit-data

---

### GET /categories/{category}/edit-data

**Handler:** App\Http\Controllers\Admin\CategoryController::class, 'editData'

**Description:** Retrieve a specific edit-data

---

### GET /settings

**Handler:** App\Http\Controllers\Admin\SettingsController::class, 'edit'

**Description:** List settings

---

### PATCH /settings

**Handler:** App\Http\Controllers\Admin\SettingsController::class, 'update'

**Description:** Update a specific settings

---

### POST /logout

**Handler:** AdminLoginController::class, 'logout'

**Description:** Create a new logout

---

### GET /orders

**Handler:** OrderController::class, 'index'

**Description:** List orders

---

### GET /orders/{order}

**Handler:** OrderController::class, 'show'

**Description:** Retrieve a specific {order}

---

### POST /orders/{order}/status

**Handler:** OrderController::class, 'updateStatus'

**Description:** Create a new status

---

### POST /orders/{order}/refund

**Handler:** OrderController::class, 'refund'

**Description:** Create a new refund

---

### GET /orders/{order}/packing-slip

**Handler:** OrderController::class, 'packingSlip'

**Description:** Retrieve a specific packing-slip

---

### GET /register

**Handler:** AuthController::class, 'showRegisterForm'

**Description:** List register

---

### POST /register

**Handler:** AuthController::class, 'register'

**Description:** Create a new register

---

### GET /

**Handler:** AuthController::class, 'showLoginForm'

**Description:** List resource

---

### GET /login

**Handler:** AuthController::class, 'showLoginForm'

**Description:** List login

---

### POST /

**Handler:** AuthController::class, 'login'

**Description:** Create a new resource

---

### POST /logout

**Handler:** AuthController::class, 'logout'

**Description:** Create a new logout

---

### GET /forgot-password

**Handler:** AuthController::class, 'showForgotForm'

**Description:** List forgot-password

---

### POST /forgot-password

**Handler:** AuthController::class, 'sendResetLink'

**Description:** Create a new forgot-password

---

### GET /reset-password/{token}

**Handler:** AuthController::class, 'showResetForm'

**Description:** Retrieve a specific {token}

---

### POST /reset-password

**Handler:** AuthController::class, 'reset'

**Description:** Create a new reset-password

---

### GET /logout-form

**Handler:** AuthController::class, 'showLogoutForm'

**Description:** List logout-form

---

### GET /profile

**Handler:** ProfileController::class, 'edit'

**Description:** List profile

---

### PATCH /profile

**Handler:** ProfileController::class, 'update'

**Description:** Update a specific profile

---

### GET /products

**Handler:** ProductController::class, 'publicIndex'

**Description:** List products

---

### GET /products/{product}

**Handler:** ProductController::class, 'publicShow'

**Description:** Retrieve a specific {product}

---

### POST /cart/add/{product}

**Handler:** CartController::class, 'add'

**Description:** Create a new {product}

---

### GET /cart

**Handler:** CartController::class, 'index'

**Description:** List cart

---

### PATCH /cart/update/{product}

**Handler:** CartController::class, 'update'

**Description:** Update a specific {product}

---

### DELETE /cart/remove/{product}

**Handler:** CartController::class, 'remove'

**Description:** Delete a specific {product}

---

### POST /cart/clear

**Handler:** CartController::class, 'clear'

**Description:** Create a new clear

---

### GET /cart/checkout

**Handler:** CartController::class, 'checkout'

**Description:** List checkout

---

### POST /cart/checkout

**Handler:** CartController::class, 'processCheckout'

**Description:** Create a new checkout

---

### POST /checkout/process

**Handler:** CheckoutController::class, 'processCheckout'

**Description:** Create a new process

---

### GET /checkout/success

**Handler:** CheckoutController::class, 'success'

**Description:** List success

---

### GET /checkout/cancel

**Handler:** CheckoutController::class, 'cancel'

**Description:** List cancel

---

### GET /products/{product}

**Handler:** ProductController::class, 'publicShow'

**Description:** Retrieve a specific {product}

---

### Resource

| Method | Endpoint | Handler | Description |
|--------|----------|---------|-------------|
| GET | /products | App\Http\Controllers\Admin\ProductController::class@index | List all products |
| GET | /products/create | App\Http\Controllers\Admin\ProductController::class@create | Show form to create a new product |
| POST | /products | App\Http\Controllers\Admin\ProductController::class@store | Store a new product |
| GET | /products/{id} | App\Http\Controllers\Admin\ProductController::class@show | Show a specific product |
| GET | /products/{id}/edit | App\Http\Controllers\Admin\ProductController::class@edit | Show form to edit product |
| PUT/PATCH | /products/{id} | App\Http\Controllers\Admin\ProductController::class@update | Update a specific product |
| DELETE | /products/{id} | App\Http\Controllers\Admin\ProductController::class@destroy | Delete a specific product |
| GET | /categories | App\Http\Controllers\Admin\CategoryController::class@index | List all categories |
| GET | /categories/create | App\Http\Controllers\Admin\CategoryController::class@create | Show form to create a new categorie |
| POST | /categories | App\Http\Controllers\Admin\CategoryController::class@store | Store a new categorie |
| GET | /categories/{id} | App\Http\Controllers\Admin\CategoryController::class@show | Show a specific categorie |
| GET | /categories/{id}/edit | App\Http\Controllers\Admin\CategoryController::class@edit | Show form to edit categorie |
| PUT/PATCH | /categories/{id} | App\Http\Controllers\Admin\CategoryController::class@update | Update a specific categorie |
| DELETE | /categories/{id} | App\Http\Controllers\Admin\CategoryController::class@destroy | Delete a specific categorie |

### GET /products

**Handler:** App\Http\Controllers\Admin\ProductController::class@index

**Description:** List all products

---

### GET /products/create

**Handler:** App\Http\Controllers\Admin\ProductController::class@create

**Description:** Show form to create a new product

---

### POST /products

**Handler:** App\Http\Controllers\Admin\ProductController::class@store

**Description:** Store a new product

---

### GET /products/{id}

**Handler:** App\Http\Controllers\Admin\ProductController::class@show

**Description:** Show a specific product

---

### GET /products/{id}/edit

**Handler:** App\Http\Controllers\Admin\ProductController::class@edit

**Description:** Show form to edit product

---

### PUT/PATCH /products/{id}

**Handler:** App\Http\Controllers\Admin\ProductController::class@update

**Description:** Update a specific product

---

### DELETE /products/{id}

**Handler:** App\Http\Controllers\Admin\ProductController::class@destroy

**Description:** Delete a specific product

---

### GET /categories

**Handler:** App\Http\Controllers\Admin\CategoryController::class@index

**Description:** List all categories

---

### GET /categories/create

**Handler:** App\Http\Controllers\Admin\CategoryController::class@create

**Description:** Show form to create a new categorie

---

### POST /categories

**Handler:** App\Http\Controllers\Admin\CategoryController::class@store

**Description:** Store a new categorie

---

### GET /categories/{id}

**Handler:** App\Http\Controllers\Admin\CategoryController::class@show

**Description:** Show a specific categorie

---

### GET /categories/{id}/edit

**Handler:** App\Http\Controllers\Admin\CategoryController::class@edit

**Description:** Show form to edit categorie

---

### PUT/PATCH /categories/{id}

**Handler:** App\Http\Controllers\Admin\CategoryController::class@update

**Description:** Update a specific categorie

---

### DELETE /categories/{id}

**Handler:** App\Http\Controllers\Admin\CategoryController::class@destroy

**Description:** Delete a specific categorie

---

