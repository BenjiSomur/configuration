FROM php:5.6-fpm

RUN docker-php-ext-install pdo_mysql

FROM composer:2.2

RUN mkdir /usr/share/nginx/html/pdfWord

COPY . /usr/share/nginx/html/pdfWord

RUN mkdir usr/share/nginx/html/pdfWord/results

WORKDIR /usr/share/nginx/html/pdfWord

RUN composer require phpoffice/phpword:0.18.3
