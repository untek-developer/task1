# Тестовое задание

## Установка

Выполните команды:

    git clone git@github.com:zndeveloper/task1.git .
    composer install
    cp .env.example .env
    php artisan key:generate

Откройте файл `.env` и настройте соединение с БД.

Запуск миграций БД:

    php artisan migrate

## Запуск

Запуск сервера:

    php artisan serve

Запуск автотестов:

    php vendor/phpunit/phpunit/phpunit

## Документация API

* [API документация (локальный Swagger)](http://127.0.0.1:8000/api/documentation)
* [API документация (глобальный Swagger)](https://app.swaggerhub.com/apis/THEYAMSHIKOV/test-project/1.0.0)
