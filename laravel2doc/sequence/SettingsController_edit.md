sequenceDiagram
    autonumber
    participant C as Client
    participant R as Route
    participant SettingsController as SettingsController
    participant V as Validator
    participant Setting as Setting
    participant DB as Database
    
    C->>R: PUT /resource/{id}
    R->>+SettingsController: edit(request, id)
    SettingsController->>+V: validate(request)
    V-->>-SettingsController: validated data
    SettingsController->>+Setting: find(id)
    Setting->>+DB: SELECT * FROM table WHERE id = ?
    DB-->>-Setting: Return record
    Setting-->>-SettingsController: Model instance
    SettingsController->>+Setting: update(data)
    Setting->>+DB: UPDATE table SET ... WHERE id = ?
    DB-->>-Setting: Success
    Setting-->>-SettingsController: Updated model
    SettingsController-->>-R: Return JSON response
    R-->>C: 200 OK with data
    
    Note over SettingsController,Setting: This sequence updates an existing resource
  