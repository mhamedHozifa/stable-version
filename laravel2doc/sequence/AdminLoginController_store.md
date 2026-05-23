sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant AdminLoginController as AdminLoginController
    participant V as Validator
    participant Model as Model
    participant DB as Database
    
    C->>R: POST /resource
    R->>+AdminLoginController: store(request)
    AdminLoginController->>+V: validate(request)
    V-->>-AdminLoginController: validated data
    AdminLoginController->>+Model: create(data)
    Model->>+DB: INSERT INTO table
    DB-->>-Model: Return new record
    Model-->>-AdminLoginController: New model instance
    AdminLoginController-->>-R: Return JSON response
    R-->>C: 201 Created with data
    
    Note over AdminLoginController,Model: This sequence creates a new resource
  