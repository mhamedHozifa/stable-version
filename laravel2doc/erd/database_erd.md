erDiagram
  category {
    int id PK "Primary key"
    string name
    string slug
    string description
    string site_type
    datetime created_at
    datetime updated_at
  }
  order {
    int id PK "Primary key"
    int user_id FK "References user"
    string order_number
    string status
    string total
    string shipping_address
    string billing_address
    string payment_method
    string payment_status
    string notes
    datetime created_at
    datetime updated_at
  }
  orderitem {
    int id PK "Primary key"
    int order_id FK "References order"
    int product_id FK "References product"
    string product_name
    string price
    string quantity
    string total
    datetime created_at
    datetime updated_at
  }
  product {
    int id PK "Primary key"
    string name
    string description
    float price
    string stock
    int category_id FK "References category"
    string image
    boolean is_featured
    json attributes
    datetime created_at
    datetime updated_at
  }
  refund {
    int id PK "Primary key"
    int order_id FK "References order"
    string amount
    string reason
    string status
    datetime processed_at
    datetime created_at
    datetime updated_at
  }
  setting {
    int id PK "Primary key"
    string key
    string value
    datetime created_at
    datetime updated_at
  }
  user {
    int id PK "Primary key"
    string name
    string email
    string password
    string role
    datetime created_at
    datetime updated_at
  }
  category ||--|{ product : "products"
  order ||--|{ orderitem : "items"
  order ||--|{ refund : "refunds"
  order }|--|| user : "user"
  orderitem }|--|| order : "order"
  orderitem }|--|| product : "product"
  product }|--|| category : "category"
  refund }|--|| order : "order"
