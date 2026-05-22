sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant ProductController as ProductController
    participant Category as Category
    participant DB as Database
    
    C->>R: GET /resource
    R->>+ProductController: index()
    ProductController->>+Category: all() / get() / paginate()
    Category->>+DB: SELECT * FROM table
    DB-->>-Category: Return records
    Category-->>-ProductController: Collection of models
    ProductController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over ProductController,Category: This sequence retrieves a list of resources
  