## How to setup the project

Run the commands
- git clone https://github.com/TropaMXmd/survey-management-system.git
- cd survey-management-system
- cp .env.example .env
- docker-compose build
- docker-compose up -d

Application URL: http://localhost:8088/

To run the artisan command inside the docker php container run the commands:
- docker exec it survey-management-system_php_1 bash

Then inside the php container run the following commands:
To migrate table: php artisan migrate
To seed the table: php artisan db:seed

A postman api collection is included with the project to test api endpoints