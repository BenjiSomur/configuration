FROM php:5.6-fpm
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer



RUN docker-php-ext-install pdo_mysql



