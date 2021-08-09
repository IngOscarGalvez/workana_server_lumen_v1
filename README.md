# Workana Server - Planning Poker's - Lumen

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://lumen.laravel.com/docs/)


Clone the repository

    git clone https://github.com/IngOscarGalvez/workana_server_lumen_v1

Switch to the repo folder

    cd workana_server_lumen_v1

Install all the dependencies using composer

    composer install   

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations & seeder (**Set the database connection in .env before migrating**)

    php artisan migrate:fresh --seed

Generate to passport

    php artisan jwt:secret

This will update your .env file with something like JWT_SECRET=foobar

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/IngOscarGalvez/workana_server.git
    cd workana_server
    composer install    
    cp .env.example .env
    php artisan key:generate
    php artisan migrate:fresh --seed
    php artisan jwt:secret
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan serve

----------

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers/Api` - Contains all the controllers
- `app/Http/Controllers/Api` - Contains all the api controllers
- `app/Http/Requests` - Contains all the form requests
- `app/Http/Requests/Api` - Contains all the api form requests
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the api routes defined in web.php file

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000

The accessed at Administrator

    User : admin@admin.com
    Pass : 123456aD

# Test Unit
    vendor/bin/phpunit
use Phpunit for testing the entire application
***Note*** :Restart the databases and use the seeds already configured by default.
    
    
