sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant OrderController as OrderController
    participant Order as Order
    participant DB as Database
    
    C->>R: Request
    R->>+OrderController: updateStatus()
    Note over OrderController: Process request
    alt Uses database
      OrderController->>+Order: operation()
      Order->>+DB: Database query
      DB-->>-Order: Return data
      Order-->>-OrderController: Return result
    else Direct response
      Note over OrderController: Process without database
    end
    OrderController-->>-R: Return response
    R-->>C: Response
    
    Note over OrderController: Generic operation flow
  