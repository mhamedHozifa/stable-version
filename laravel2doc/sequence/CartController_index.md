sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CartController as CartController
    participant Model as Model
    participant DB as Database
    
    C->>R: GET /resource
    R->>+CartController: index()
    CartController->>+Model: all() / get() / paginate()
    Model->>+DB: SELECT * FROM table
    DB-->>-Model: Return records
    Model-->>-CartController: Collection of models
    CartController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over CartController,Model: This sequence retrieves a list of resources
  