sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant OrderController as OrderController
    participant Refund as Refund
    participant DB as Database
    
    C->>R: Request
    R->>+OrderController: refund()
    Note over OrderController: Process request
    alt Uses database
      OrderController->>+Refund: operation()
      Refund->>+DB: Database query
      DB-->>-Refund: Return data
      Refund-->>-OrderController: Return result
    else Direct response
      Note over OrderController: Process without database
    end
    OrderController-->>-R: Return response
    R-->>C: Response
    
    Note over OrderController: Generic operation flow
  