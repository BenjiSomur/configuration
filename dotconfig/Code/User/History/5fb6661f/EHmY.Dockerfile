FROM php:5.6-fpm

RUN docker-php-ext-install pdo_mysql

FROM composer:2.2

WORKDIR /app/public/pdfWord

