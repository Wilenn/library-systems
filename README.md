Library System
Description
Simple Library Information System built using Laravel and MySQL.

This project was created as part of the Laravel Environment Setup assignment. Its purpose is to prepare a Laravel development environment and connect the application to a MySQL database.

Requirements
Before running this project, make sure the following software is installed:

PHP
Composer
MySQL
Laravel
Git
Installation
Clone the repository.

git clone https://github.com/USERNAME/library-system.git
Enter the project directory.

cd library-system
Install Composer dependencies.

composer install
Copy the environment configuration file.

cp .env.example .env
Generate the Laravel application key.

php artisan key:generate
Create a MySQL database named library_system.

Configure the database connection in the .env file.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_system
DB_USERNAME=root
DB_PASSWORD=
Run the database migrations.

php artisan migrate
Start the Laravel development server.

php artisan serve
Open the application in a web browser.

http://127.0.0.1:8000
Database
This project uses MySQL as the database management system.

Database name: library_system

Author
Waylend Yutani