FROM php:5.6-fpm

RUN docker-php-ext-install pdo_mysql

FROM composer:2.2

RUN mkdir /usr/share/nginx/html/pdfWord

WORKDIR /app/public/

COPY . /usr/share/nginx/html/pdfWord

RUN mkdir usr/share/nginx/html/pdfWord/results

RUN composer install phpoffice/phpword --version=0.18.3 --dir
