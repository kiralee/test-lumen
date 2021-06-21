#!/bin/bash

echo "####### Up containers"
docker-compose up -d

echo "####### Running composer install"
docker exec container_php_fpm composer install

echo "####### Copy env file"
docker exec container_php_fpm composer run post-root-package-install

echo "####### Migrate DB"
docker exec container_php_fpm php artisan migrate

echo "####### Change Mode Storage"
docker exec container_php_fpm chmod -R 777 storage/

echo "==== SUCCESS BUILD ===="
echo "Please run application with domain http://127.0.0.1:8888"