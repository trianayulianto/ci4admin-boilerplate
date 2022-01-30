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

## Login
Login using default account username `superuser@mail.test` & password `password`

## Defender
Defender is an Access Control List (ACL) Solution for Laravel 5 / 6 / 7 (single auth). (Not compatible with multi-auth). For more information, go to this link https://github.com/artesaos/defender
- Configuration
By default the configuration file is in this path `app/ThirdParty/ci4-eloquent/src/defender/Config/Defender.php`. But, if you want to make your own configuration you can extend it to `app/Config`.

## Warning
- Ini aku gunakan untuk belajar, do not use in prod.
- Reset JWT token only work in https only
- For more information, DYOR!

## Inspires
- agungsugiarto/codeigniter4-authentication https://github.com/agungsugiarto/codeigniter4-authentication
- agungsugiarto/codeigniter4-authentication-jwt https://github.com/agungsugiarto/codeigniter4-authentication-jwt
- Laravel Defender https://github.com/artesaos/defender