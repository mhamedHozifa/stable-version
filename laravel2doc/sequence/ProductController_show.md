sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ProductController as ProductController
    participant Model as Model
    participant DB as Database
    
    C->>R: GET /resource/{id}
    R->>+ProductController: show(id)
    ProductController->>+Model: find(id) / findOrFail(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-ProductController: Model instance
    ProductController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over ProductController,Model: This sequence retrieves a specific resource by ID
  