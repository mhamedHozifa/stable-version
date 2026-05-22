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
  Category --* Product : products
  Order --* OrderItem : items
  Order --* Refund : refunds
  Order <-- User : user
  OrderItem <-- Order : order
  OrderItem <-- Product : product
  Product <-- Category : category
  Refund <-- Order : order
