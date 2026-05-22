sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CheckoutController as CheckoutController
    participant Order as Order
    participant DB as Database
    
    C->>R: Request
    R->>+CheckoutController: success()
    Note over CheckoutController: Process request
    alt Uses database
      CheckoutController->>+Order: operation()
      Order->>+DB: Database query
      DB-->>-Order: Return data
      Order-->>-CheckoutController: Return result
    else Direct response
      Note over CheckoutController: Process without database
    end
    CheckoutController-->>-R: Return response
    R-->>C: Response
    
    Note over CheckoutController: Generic operation flow
  