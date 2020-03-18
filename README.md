<!-- PROJECT LOGO -->
<br />
<p align="center">
  <h3 align="center">Тестовое задание Trueconf</h3>
</p>

<!-- TABLE OF CONTENTS -->

## Table of Contents

- [About the Project](#about-the-project)
  - [Built With](#built-with)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation and Start](#installation-and-start)

<!-- ABOUT THE PROJECT -->

## About The Project

В рамках данного тестового задания реализован базовый api по работе с сущностью User.
| URL | METHOD | DESCRIPTION |
| --- | --- | --- | --- | --- |
| /users | GET | Получение списка пользователей |
| /users/{id} | GET | Получение пользователя по id |
| /users | POST | Добавление пользователя |
| /users/{id} | DELETE | Удаление пользователя по id |
| /users/{id} | PATCH | Обновление пользователя по id |

Формат данных пользователя:

```json
{
  "username": "alex.ivanov",
  "first_name": "Alex",
  "last_name": "Ivanov",
  "email": "alex.ivanov@example.com"
}
```

### Built With

- [PHP-Slim](http://www.slimframework.com/)

<!-- GETTING STARTED -->

## Getting Started

### Prerequisites

- composer https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos

### Installation and Start

1. Клонировать репозиторий

```sh
git clone https://github.com/NA-Dronov/trueconf-test
```

2. В папке проекта. Установить зависимости, используя composer

```sh
composer install
```
