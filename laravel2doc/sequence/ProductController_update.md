sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ProductController as ProductController
    participant V as Validator
    participant Model as Model
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+ProductController: update(request, id)
    ProductController->>+V: validate(request)
    V-->>-ProductController: validated data
    ProductController->>+Model: find(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-ProductController: Model instance
    ProductController->>+Model: update(data)
    Model->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-Model: Success
    Model-->>-ProductController: Updated model
    ProductController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over ProductController,Model: This sequence updates an existing resource
  