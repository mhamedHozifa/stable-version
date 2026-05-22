sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CheckoutController as CheckoutController
    participant Model as Model
    participant DB as Database
    
    C->>R: Request
    R->>+CheckoutController: processCheckout()
    Note over CheckoutController: Process request
    alt Uses database
      CheckoutController->>+Model: operation()
      Model->>+DB: Database query
      DB-->>-Model: Return data
      Model-->>-CheckoutController: Return result
    else Direct response
      Note over CheckoutController: Process without database
    end
    CheckoutController-->>-R: Return response
    R-->>C: Response
    
    Note over CheckoutController: Generic operation flow
  