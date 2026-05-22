sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CartController as CartController
    participant Model as Model
    participant DB as Database
    
    C->>R: Request
    R->>+CartController: clear()
    Note over CartController: Process request
    alt Uses database
      CartController->>+Model: operation()
      Model->>+DB: Database query
      DB-->>-Model: Return data
      Model-->>-CartController: Return result
    else Direct response
      Note over CartController: Process without database
    end
    CartController-->>-R: Return response
    R-->>C: Response
    
    Note over CartController: Generic operation flow
  