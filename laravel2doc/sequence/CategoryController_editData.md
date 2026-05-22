sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CategoryController as CategoryController
    participant Model as Model
    participant DB as Database
    
    C->>R: Request
    R->>+CategoryController: editData()
    Note over CategoryController: Process request
    alt Uses database
      CategoryController->>+Model: operation()
      Model->>+DB: Database query
      DB-->>-Model: Return data
      Model-->>-CategoryController: Return result
    else Direct response
      Note over CategoryController: Process without database
    end
    CategoryController-->>-R: Return response
    R-->>C: Response
    
    Note over CategoryController: Generic operation flow
  