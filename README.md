# Task: REST API Development in Laravel

## Objective
Develop a comprehensive REST API using Laravel that manages five entities. The API should support full CRUD operations for all entities and implement a basic security setup utilizing bearer tokens for authentication.

## Entities
1. **User** - with unique_id, username, email, f_name, l_name, created_at, updated_at.
2. **Role** - with unique_id, name, created_at, updated_at.
3. **Project** - with unique_id, name, description, start date, end date, and status, created_at, updated_at.
4. **Task** - with unique_id, task name, description, due date, priority, created_at, updated_at.
5. **Comment** - with unique_id, comment text, created_at, updated_at.

## Requirements

### API Endpoints
Create RESTful endpoints for each entity to perform CRUD operations. The endpoints must be designed following best practices and REST standards.
- **User and Role Management:** Include endpoints to create, read, update, and delete users and roles.
- **Associations:** Implement proper associations between entities. For example, users should be able to have roles, tasks can belong to projects, and comments should be related to tasks and users.

### Authentication & Authorization
- Implement bearer token-based authentication using Laravel's built-in features or packages like Laravel Passport.
- Ensure that only authenticated users can access the API endpoints. Use roles to manage access control and permissions for different types of operations.

### Database Design
- Design a relational database schema that supports all entities and their relationships.
- Use Laravel migrations to manage the database schema.

### Validation & Error Handling
- Add request validation to ensure that incoming data is valid before performing operations.
- Implement error handling to return meaningful error responses in case of failures or invalid requests.

### Security
- Ensure the API is secure against common vulnerabilities like SQL injection, cross-site scripting (XSS), and cross-site request forgery (CSRF).
- Use HTTPS to encrypt data in transit.

### Documentation
- Document the API endpoints, including the URL, HTTP method, request parameters, and example responses.
- You can use tools like Swagger or Postman (Insomnia) to create and maintain the API documentation.

## Deliverables
- Source code for the application.
- Database migrations and seeders for initial data.
- API documentation accessible through a web interface or a collection document.

## Evaluation Criteria
- Adherence to Laravel best practices and design patterns.
- Clarity and maintainability of code.
- Security implementations and considerations.
- Completeness of API functionalities and documentation.

This task is designed to test the comprehensive abilities of a PHP developer in creating a secure, robust, well-documented REST API using Laravel. It requires some understanding of the Laravel framework, database design, RESTful principles, and security best practices.

INSTRUCTIONS ON HOW TO RUN APP GOES UNDER THIS LINE
###################################################
