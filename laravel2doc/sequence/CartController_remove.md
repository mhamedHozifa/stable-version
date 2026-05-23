sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CartController as CartController
    participant Product as Product
    participant DB as Database
    
    C->>R: DELETE /resource/{id}
    R->>+CartController: remove(id)
    CartController->>+Product: find(id)
    Product->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Product: Return record
    Product-->>-CartController: Model instance
    CartController->>+Product: delete()
    Product->>+DB: DELETE FROM table WHERE id = ?
    DB-->>-Product: Success
    Product-->>-CartController: Success
    CartController-->>-R: Return JSON response
    R-->>C: 204 No Content
    
    Note over CartController,Product: This sequence removes a resource
  