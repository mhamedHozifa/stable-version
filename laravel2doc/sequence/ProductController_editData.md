sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ProductController as ProductController
    participant Model as Model
    participant DB as Database
    
    C->>R: Request
    R->>+ProductController: editData()
    Note over ProductController: Process request
    alt Uses database
      ProductController->>+Model: operation()
      Model->>+DB: Database query
      DB-->>-Model: Return data
      Model-->>-ProductController: Return result
    else Direct response
      Note over ProductController: Process without database
    end
    ProductController-->>-R: Return response
    R-->>C: Response
    
    Note over ProductController: Generic operation flow
  