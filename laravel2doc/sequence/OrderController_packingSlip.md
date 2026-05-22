sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant OrderController as OrderController
    participant Model as Model
    participant DB as Database
    
    C->>R: Request
    R->>+OrderController: packingSlip()
    Note over OrderController: Process request
    alt Uses database
      OrderController->>+Model: operation()
      Model->>+DB: Database query
      DB-->>-Model: Return data
      Model-->>-OrderController: Return result
    else Direct response
      Note over OrderController: Process without database
    end
    OrderController-->>-R: Return response
    R-->>C: Response
    
    Note over OrderController: Generic operation flow
  