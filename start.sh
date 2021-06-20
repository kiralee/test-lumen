#!/bin/bash
docker-compose up -d
echo "####### Running composer install"
docker exec container_php_fpm composer install
echo "####### Copy env file"
docker exec container_php_fpm composer run post-root-package-install
echo "####### Start Queue and keep idle"
docker exec container_php_fpm php artisan queue:listen