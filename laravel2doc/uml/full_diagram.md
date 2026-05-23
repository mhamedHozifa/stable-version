classDiagram
  class Category {
    +name
    +slug
    +description
    +site_type
  }
  class Order {
    +user_id
    +order_number
    +status
    +total: decimal:2
    +shipping_address
    +billing_address
    +payment_method
    +payment_status
    +notes
  }
  class OrderItem {
    +order_id
    +product_id
    +product_name
    +price: decimal:2
    +quantity
    +total: decimal:2
  }
  class Product {
    +name
    +description
    +price
    +stock
    +category_id
    +image
    +is_featured
    +attributes: array
  }
  class Refund {
    +order_id
    +amount: decimal:2
    +reason
    +status
    +processed_at: datetime
  }
  class Setting {
    +key
    +value
  }
  class User {
    +name
    +email
    +password
    +role
    +isAdmin()
  }
  class AdminLoginController {
    <<Controller>>
    +create()
    +store(Request $request)
    +logout(Request $request)
    +createWelcome()
  }
  class CategoryController {
    <<Controller>>
    +index()
    +create()
    +store(Request $request)
    +edit(Category $category)
    +update(Request $request, Category $category)
    +destroy(Category $category)
    +editData(Category $category)
  }
  class OrderController {
    <<Controller>>
    +index(Request $request)
    +show(Order $order)
    +updateStatus(Request $request, Order $order)
    +refund(Request $request, Order $order)
    +packingSlip(Order $order)
  }
  class ProductController {
    <<Controller>>
    +index()
    +create()
    +store(Request $request)
    +show(string $id)
    +edit(string $id)
    +update(Request $request, Product $product)
    +destroy(Product $product)
    +editData(Product $product)
    +publicIndex()
    +publicShow(Product $product)
  }
  class SettingsController {
    <<Controller>>
    +edit()
    +update(Request $request)
  }
  class CartController {
    <<Controller>>
    +__construct(Cart $cart)
    +add(Request $request, Product $product)
    +index()
    +update(Request $request, Product $product)
    +remove(Product $product)
    +clear()
    +checkout()
    +processCheckout(Request $request)
  }
  class CheckoutController {
    <<Controller>>
    +__construct(Cart $cart)
    +processCheckout(Request $request)
    +success(Request $request)
    +cancel()
  }
  class Controller {
    <<Controller>>
  }
  class AuthController {
    <<Controller>>
    +showRegisterForm()
    +register(Request $request)
    +showLoginForm()
    +login(Request $request)
    +logout(Request $request)
    +showForgotForm()
    +sendResetLink(Request $request)
    +showResetForm($token)
    +reset(Request $request)
    +showLogoutForm()
  }
  class ProfileController {
    <<Controller>>
    +edit()
    +update(Request $request)
  }
  Category --* Product : products
  Order --* OrderItem : items
  Order --* Refund : refunds
  Order <-- User : user
  OrderItem <-- Order : order
  OrderItem <-- Product : product
  Product <-- Category : category
  Refund <-- Order : order
