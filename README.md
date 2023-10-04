<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

A Demo Project of Expense Tracker Manager. Consisting to following tools
1. Laravel 10
2. REST API
3. Design pattern - Repository, Service, DTO

## Getting Started Step by Step
1. In your root folder, clone the project file using git clone {project_repo}
2. Open terminal (bash/cmd). Then go to project folder using command

```sh
cd {project_repo}
```

3. Then install required files and libraries using 

```sh
composer install
```

4. Then create a .env file and generate key for this project using command 

```sh
cp .env.example .env

php artisan key:generate
```
5. Create a database in MYSQL and connect it with your project via updating .env file.
6. After connecting the db with project, then run command 

```sh
php artisan migrate:fresh --seed
```
This is will run migration and seeder classes to feed some dummy data to check on api call.


