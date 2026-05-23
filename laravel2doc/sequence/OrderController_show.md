sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant OrderController as OrderController
    participant Model as Model
    participant DB as Database
    
    C->>R: GET /resource/{id}
    R->>+OrderController: show(id)
    OrderController->>+Model: find(id) / findOrFail(id)
    Model->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Model: Return record
    Model-->>-OrderController: Model instance
    OrderController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over OrderController,Model: This sequence retrieves a specific resource by ID
  