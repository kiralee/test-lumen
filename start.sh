#!/bin/bash
docker-compose up -d
docker exec container_php_fpm composer install