FROM php:5.6-fpm
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app/public

COPY index.php;


RUN php composer install phpoffice/phpword -version=0.18.3

RUN docker-php-ext-install pdo_mysql



