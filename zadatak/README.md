# Task: REST API Development in Laravel

## INSTALLATION STEPS

*preferably linux

1. Clone repo in local directory

2. Create local database 

3. Position yourself on the project folder (console) and type:

- composer install
- cp .env.example .env 
- adjust .env settings:

Open .env in your IDE and set db connection as described bellow

DB_DATABASE={db name}
DB_USERNAME={db username}
DB_PASSWORD={db password}

Back to console and type: 
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan storage:link
- php artisan jwt:secret

Laravel server
- type in console: php artisan serve

API

- We have three roles in the system, Admin, Client, Candidate. Admin is allowed to perform any action. 
Client is allowed to perform creating and updating `tasks` and `comments` and reading `projects` resource.
Candidate is allowed to perform creating and updating `comments` and reading `projects` resource.   

1. Open Postman
2. Type in url line: http://127.0.0.1:8000/
3. Available routes:

Auth
- POST /api/login
- POST /api/register-user

credentials:
1. admin - admin@mail.com, pass: password
2. client - client@mail.com, pass: password
3. candidate - candidate@mail.com, pass: password

Roles
- GET /api/roles
- GET /api/roles/{role}
- POST /api/roles
- PUT /api/roles/{role}
- DELETE /api/roles/{role}

Users
- GET /api/users
- GET /api/users/{user}
- POST /api/users
- PUT /api/users
- DELETE /api/users

Projects
- GET /api/projects
- GET /api/projects/{project}
- POST /api/projects
- PUT /api/projects/{project}
- DELETE /api/projects/{projects}

Tasks
- GET /api/tasks
- GET /api/tasks/{task}
- POST /api/tasks
- PUT /api/tasks/{task}
- DELETE /api/tasks/{task}

Comments
- GET /api/comments
- GET /api/comments/{comment}
- POST /api/comments
- PUT /api/comments/{comment}
- DELETE /api/comments/{comment}
