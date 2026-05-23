sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant AdminLoginController as AdminLoginController
    participant Model as Model
    participant DB as Database
    
    C->>R: Request
    R->>+AdminLoginController: createWelcome()
    Note over AdminLoginController: Process request
    alt Uses database
      AdminLoginController->>+Model: operation()
      Model->>+DB: Database query
      DB-->>-Model: Return data
      Model-->>-AdminLoginController: Return result
    else Direct response
      Note over AdminLoginController: Process without database
    end
    AdminLoginController-->>-R: Return response
    R-->>C: Response
    
    Note over AdminLoginController: Generic operation flow
  