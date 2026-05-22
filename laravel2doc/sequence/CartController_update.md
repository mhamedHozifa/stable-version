sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant CartController as CartController
    participant V as Validator
    participant Product as Product
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+CartController: update(request, id)
    CartController->>+V: validate(request)
    V-->>-CartController: validated data
    CartController->>+Product: find(id)
    Product->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Product: Return record
    Product-->>-CartController: Model instance
    CartController->>+Product: update(data)
    Product->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-Product: Success
    Product-->>-CartController: Updated model
    CartController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over CartController,Product: This sequence updates an existing resource
  