sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CategoryController as CategoryController
    participant V as Validator
    participant Model as Model
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+CategoryController: edit(request, id)
    CategoryController->>+V: validate(request)
    V-->>-CategoryController: validated data
    CategoryController->>+Model: find(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-CategoryController: Model instance
    CategoryController->>+Model: update(data)
    Model->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-Model: Success
    Model-->>-CategoryController: Updated model
    CategoryController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over CategoryController,Model: This sequence updates an existing resource
  