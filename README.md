<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

----------

# Getting started
## About
This application is using Laravel 9 and PHP 8

## Installation
Clone the repository

    git clone https://github.com/janehernandez/fertiliser-app.git

Switch to the repo folder

    cd fertiliser-app

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Alternatively, you can run migration with seeder classes (**Set the database connection in .env before migrating**)

    php artisan migrate:fresh --seed

Install all Node packages using npm 
    npm install

Run your local Development server
    npm run dev

**Sequence Command list**

    git clone https://github.com/janehernandez/fertiliser-app.git
    cd fertiliser-app
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    php artisan jwt:generate 

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    npm run dev or npm run build

## Database seeding

**Populate the database with seed data with relationships which includes users, and permissions. This can help you to quickly start testing a couple of frontend functionalities and start using it with ready content.**

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:fresh

# Code overview

## Laravel Dependencies
- [laravel-jetstream](https://jetstream.laravel.com/2.x/introduction.html) - Laravel Jetstream is a beautifully designed application starter kit for Laravel and provides the perfect starting point for your next Laravel application
- [inertiajs](https://inertiajs.com) - Inertia.js lets you quickly build modern single-page React, Vue and Svelte apps using classic server-side routing and controllers.

## Frontend Packages
- [inertiajs](https://inertiajs.com) - Inertia.js lets you quickly build modern single-page React, Vue and Svelte apps using classic server-side routing and controllers.
- [tailwindcss](https://tailwindcss.com/) - Tailwind CSS is a utility-first CSS framework designed to enable users to create applications faster and easier. 
- [lodash](https://lodash.com/) - A modern JavaScript utility library delivering modularity, performance & extras. 

## Environment variables

- `.env` - Environment variables can be set in this file

## Unit Testing
Unit Testing is very crucial in testing an application, this is a way to prevent other developers breaking the code. to run the test in this app, kindly execute:

    php artisan test

Alternatively, you can run the testing and stop the execution when there is an error found:

    php artisan test --testsuite=Feature --stop-on-failure

***Note*** : When there is an issue that the unit testing is not running because of an error with Vite, kindly run this command and proceed with the unit testing again:

    npm run build