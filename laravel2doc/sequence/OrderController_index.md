sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant OrderController as OrderController
    participant Order as Order
    participant DB as Database
    
    C->>R: GET /resource
    R->>+OrderController: index()
    OrderController->>+Order: all() / get() / paginate()
    Order->>+DB: SELECT * FROM table
    DB-->>-Order: Return records
    Order-->>-OrderController: Collection of models
    OrderController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over OrderController,Order: This sequence retrieves a list of resources
  