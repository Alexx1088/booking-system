# Разработка системы управления бронированием ресурсов
Данный проект включает в себя RESTful API для системы управления бронированием ресурсов. Например, у нас есть различные ресурсы 
(например, комнаты, автомобили и т.д.), которые можно бронировать на определённое время. 

## Требования к проекту

- PHP 8.2
- Laravel 11
- MySQL 8
- Composer
- Docker

## Установка и запуск через Docker

### 1. Склонируйте репозиторий, установите зависимости:

git clone https://github.com/Alexx1088/booking-system.git

установить зависимости через Composer, сгенерировать application key:

composer install
php artisan key:generate

### 2.  Собрать и запустить контейнеры:

docker-compose up --build -d

### 3.Скопировать файл .env.example в .env

### 4. Проверить настройки базы данных и убедится, что они соответствуют данным из docker-compose.yml

### 5. Выполнить миграции

docker exec -it management php artisan migrate

### 6. Администрирование базы данных (веб-приложение Adminer):

Adminer доступен по адресу: http://localhost:8093

сервер: db
логин: root
пароль: root
база данных: management_db

### 7. Сгенерировать документацию Swagger

php artisan l5-swagger:generate

Перейти по адресу: http://localhost:8894/api/documentation# для просмотра документации Swagger

## 8. REST API Методы

GET   /api/resources - получение списка всех ресурсов  
POST  /api/resources - cоздание ресурса   
POST  /api/bookings  - cоздание бронирования  
GET   /api/resources/{id}/bookings - получение всех бронирований для ресурса  
DELETE /api/bookings/{id} - отмена бронирования  

## 9. Тестирование

для запуска тестов выполнить команду: php artisan test

## 10. Использование Observer для уведомлений о создании или отмене бронирования.

при создании или отмене бронирования, уведомления записываются в файл storage/logs/laravel.log

## 11. Контакты

Если у вас есть вопросы по проекту, вы можете связаться со мной:

telegram: @alexx108
