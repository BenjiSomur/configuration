FROM php:5.6-fpm

RUN docker-php-ext-install pdo_mysql

FROM composer:2.2

WORKDIR /app/public/

RUN mkdir pdfWord

COPY index.php ./pdfWord

COPY resources ./pdfWord

RUN mkdir ./pdfWord/results

RUN composer install phpoffice/phpword --version=0.18.3 
