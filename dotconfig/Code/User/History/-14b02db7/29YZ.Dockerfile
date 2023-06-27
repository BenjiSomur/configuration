FROM php:5.6-fpm
FROM composer

RUN docker-php-ext-install pdo_mysql