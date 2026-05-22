sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ProductController as ProductController
    participant Model as Model
    participant DB as Database
    
    C->>R: DELETE /resource/{id}
    R->>+ProductController: destroy(id)
    ProductController->>+Model: find(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-ProductController: Model instance
    ProductController->>+Model: delete()
    Model->>+DB: DELETE FROM table WHERE id = ?
    DB-->>-Model: Success
    Model-->>-ProductController: Success
    ProductController-->>-R: Return JSON response
    R-->>C: 204 No Content
    
    Note over ProductController,Model: This sequence removes a resource
  