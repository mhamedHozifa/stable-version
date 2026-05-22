sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ProductController as ProductController
    participant Product as Product
    participant DB as Database
    
    C->>R: Request
    R->>+ProductController: publicIndex()
    Note over ProductController: Process request
    alt Uses database
      ProductController->>+Product: operation()
      Product->>+DB: Database query
      DB-->>-Product: Return data
      Product-->>-ProductController: Return result
    else Direct response
      Note over ProductController: Process without database
    end
    ProductController-->>-R: Return response
    R-->>C: Response
    
    Note over ProductController: Generic operation flow
  