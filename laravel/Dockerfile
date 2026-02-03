FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl git libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html
