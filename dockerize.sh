#!/bin/sh
reset_migration=$1

docker-compose build

docker-compose up -d --remove-orphans

docker-compose exec app composer install

if [ "$reset_migration" = '--reset_migration' ]
then
    docker-compose exec app php artisan migrate:fresh
else
    docker-compose exec app php artisan migrate
fi

docker-compose exec app php artisan db:seed --class=UsersTableSeeder

docker-compose exec app php artisan db:seed --class=SymptomsTableSeeder
