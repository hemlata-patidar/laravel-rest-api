docker run --rm \
 -v $(pwd):/var/www/html \
 -w /var/www/html \
 laravelsail/php83-composer:latest \
 composer create-project laravel/laravel laravel "11.\*"

create project using above command
http://localhost:8000
docker compose up -d --build
docker compose exec web php artisan key:generate

docker compose up -d # Start containers
docker compose down # Stop containers
docker compose exec web bash # Enter PHP container shell
docker compose exec web php artisan make:controller ApiController
docker compose exec db mysql -u root -p
passward - root
docker compose exec web php artisan migrate
docker compose exec web php artisan serve --host=0.0.0.0 --port=8080

laravel/
├── app/
│ ├── Http/Controllers/
│ ├── Models/
│ └── Providers/RouteServiceProvider.php
├── database/
│ ├── migrations/
│ └── seeders/
├── routes/
│ ├── api.php
│ └── web.php
├── docker-compose.yml
├── .env
└── README.md

SETUP
git clone <repo-url>
cd laravel

environment config
cp .env.example .env

database (Docker mysql)
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_fsd
DB_USERNAME=root
DB_PASSWORD=secret

start docker container
docker compose up -d

verify container
docker compose ps

install dependencies
docker compose exec web composer install
docker compose exec web php artisan key:generate

run migration
docker compose exec web php artisan migrate:fresh

seed the db
docker compose exec web php artisan db:seed

routing
routes/api.php

All api route
ex GET /api/users

verify routes
docker compose exec web php artisan route:list

you should see
GET|HEAD api/users
POST api/users
GET|HEAD api/accounts

API ENDPOINTS
| Method | Endpoint | Description |
| ------ | --------------- | ------------ |
| GET | /api/users | List users |
| POST | /api/users | Create user |
| GET | /api/users/{id} | User details |
| PUT | /api/users/{id} | Update user |
| DELETE | /api/users/{id} | Delete user |

ROLE
| Method | Endpoint |
| ------ | --------------- |
| GET | /api/roles |
| POST | /api/roles |
| GET | /api/roles/{id} |
| PUT | /api/roles/{id} |
| DELETE | /api/roles/{id} |

PERMISSIONS
| Method | Endpoint |
| ------ | --------------------- |
| GET | /api/permissions |
| POST | /api/permissions |
| GET | /api/permissions/{id} |
| PUT | /api/permissions/{id} |
| DELETE | /api/permissions/{id} |

ACCOUNTS
| Method | Endpoint |
| ------ | ------------------ |
| GET | /api/accounts |
| POST | /api/accounts |
| GET | /api/accounts/{id} |
| PUT | /api/accounts/{id} |
| DELETE | /api/accounts/{id} |

ACCOUNT LOCATIONS
| Method | Endpoint |
| ------ | ---------------------------------------- |
| GET | /api/accounts/{accountId}/locations |
| POST | /api/accounts/{accountId}/locations |
| GET | /api/accounts/{accountId}/locations/{id} |
| PUT | /api/accounts/{accountId}/locations/{id} |
| DELETE | /api/accounts/{accountId}/locations/{id} |

CAFE
| Method | Endpoint |
| ------ | -------------------------------------- |
| GET | /api/locations/{locationId}/cafes |
| POST | /api/locations/{locationId}/cafes |
| GET | /api/locations/{locationId}/cafes/{id} |
| PUT | /api/locations/{locationId}/cafes/{id} |
| DELETE | /api/locations/{locationId}/cafes/{id} |

API RESPONSE
{
"success": true,
"data": {},
"message": "Operation successful"
}

API TESTING POSTMAN
Base URL
http://localhost:8000/api

HEADERS
Accept: application/json
Content-Type: application/json

CACHE & DEBUG COMMANDS
docker compose exec web php artisan route:clear
docker compose exec web php artisan config:clear
docker compose exec web php artisan cache:clear
docker compose exec web php artisan optimize:clear
