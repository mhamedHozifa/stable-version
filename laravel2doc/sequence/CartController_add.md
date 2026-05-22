sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CartController as CartController
    participant V as Validator
    participant Product as Product
    participant DB as Database
    
    C->>R: POST /resource
    R->>+CartController: add(request)
    CartController->>+V: validate(request)
    V-->>-CartController: validated data
    CartController->>+Product: create(data)
    Product->>+DB: INSERT INTO table
    DB-->>-Product: Return new record
    Product-->>-CartController: New model instance
    CartController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over CartController,Product: This sequence creates a new resource
  