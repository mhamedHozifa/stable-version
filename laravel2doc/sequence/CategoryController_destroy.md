sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CategoryController as CategoryController
    participant Model as Model
    participant DB as Database
    
    C->>R: DELETE /resource/{id}
    R->>+CategoryController: destroy(id)
    CategoryController->>+Model: find(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-CategoryController: Model instance
    CategoryController->>+Model: delete()
    Model->>+DB: DELETE FROM table WHERE id = ?
    DB-->>-Model: Success
    Model-->>-CategoryController: Success
    CategoryController-->>-R: Return JSON response
    R-->>C: 204 No Content
    
    Note over CategoryController,Model: This sequence removes a resource
  