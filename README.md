# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Installation
```bash
$ composer Install
$ npm install && npm run dev #optional
```

## Setup
Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

```bash
$ php spark migrate
$ php spark serve
```

### Using Docker
```bash
$ docker compose up -d
$ docker compose exec app php spark migrate
```

## Seeding
```bash
$ php spark db:seed InitSeeder # to seed the default permissions & roles
$ php spark db:seed UserSeeder # to seed the default user
```
Use command `docker compose exec app php ...` instead, if you are using docker

## Login
Login using default account username `superuser@mail.test` & password `password`

## Defender
Defender is an Access Control List (ACL) Solution for Laravel 5 / 6 / 7 (single auth). (Not compatible with multi-auth).

## Warning
- Reset JWT token only work in https only
- For more information, DWYOR!

## Inspires
- agungsugiarto/codeigniter4-authentication https://github.com/agungsugiarto/codeigniter4-authentication
- agungsugiarto/codeigniter4-authentication-jwt https://github.com/agungsugiarto/codeigniter4-authentication-jwt
- Laravel Defender https://github.com/artesaos/defender
