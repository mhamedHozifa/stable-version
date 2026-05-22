sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ProductController as ProductController
    participant V as Validator
    participant Model as Model
    participant DB as Database
    
    C->>R: POST /resource
    R->>+ProductController: create(request)
    ProductController->>+V: validate(request)
    V-->>-ProductController: validated data
    ProductController->>+Model: create(data)
    Model->>+DB: INSERT INTO table
    DB-->>-Model: Return new record
    Model-->>-ProductController: New model instance
    ProductController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over ProductController,Model: This sequence creates a new resource
  