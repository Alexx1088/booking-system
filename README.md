# Resource Booking Management System

A backend service providing a RESTful API for managing resource bookings in a time-based manner.  
The system is designed to handle real-world booking scenarios for various resource types such as meeting rooms, vehicles, equipment, and other reservable assets.

The project focuses on clean API design, data consistency, and extensibility, and can serve as a foundation for larger scheduling or reservation platforms.

---

## Key Features

- RESTful API for managing resources and bookings
- Time-based booking validation to prevent conflicts
- Database seeding for quick local setup
- Observer-based event handling for booking lifecycle events
- Swagger (OpenAPI) documentation
- Automated tests for core business logic
- Fully containerized development environment using Docker

---

## Tech Stack

- PHP 8.2
- Laravel 11
- MySQL 8
- Docker & Docker Compose
- Composer
- Swagger (l5-swagger)

---

## Project Setup (Docker)

### 1. Clone the repository and install dependencies
```bash
git clone https://github.com/Alexx1088/booking-system.git
cd booking-system

composer install
php artisan key:generate
```
### 2. Build and start Docker containers
```bash
docker-compose up --build -d
```
### 3.Environment configuration
Copy the environment file:
```bash
cp .env.example .env
```
### 4. Run database migrations and seeders
```bash
docker exec -it management php artisan migrate --seed
```
### 5. Database Administration

The project includes Adminer for database management.
```bash
URL: http://localhost:8093
сервер: db
логин: root
пароль: root
база данных: management_db
```
### 6. API Documentation (Swagger)

Generate Swagger documentation:
```bash
php artisan l5-swagger:generate
```
Swagger UI will be available at:
```bash
 http://localhost:8894/api/documentation# 
```
## 7. REST API Endpoints
```bash
GET   /api/resources - Get all resources  
POST  /api/resources - Create a new resource 
POST  /api/bookings  - Create a booking
GET   /api/resources/{id}/bookings - Get all bookings for a resource
DELETE /api/bookings/{id} - Cancel a booking 
```
## 8. Testing

To run automated tests:
```bash
php artisan test
```
## 9. Booking Events & Observers

The project uses Laravel Observers to react to booking lifecycle events.

- When a booking is created or cancelled, a notification is logged

- Logs are written to:
storage/logs/laravel.log

- This approach allows the system to be easily extended with:

- Email notifications

- Webhooks

- Message queues

- Event-driven integrations

## 10. Contact

If you have any questions about the project, feel free to reach out:
telegram: @alexx108
