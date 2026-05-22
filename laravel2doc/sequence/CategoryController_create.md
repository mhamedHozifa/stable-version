sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CategoryController as CategoryController
    participant V as Validator
    participant Model as Model
    participant DB as Database
    
    C->>R: POST /resource
    R->>+CategoryController: create(request)
    CategoryController->>+V: validate(request)
    V-->>-CategoryController: validated data
    CategoryController->>+Model: create(data)
    Model->>+DB: INSERT INTO table
    DB-->>-Model: Return new record
    Model-->>-CategoryController: New model instance
    CategoryController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over CategoryController,Model: This sequence creates a new resource
  