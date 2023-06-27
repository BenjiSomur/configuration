FROM php:5.6-fpm

RUN docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app/public/phpWord

COPY index.php .
COPY resources .

RUN mkdir results

RUN php composer install phpoffice/phpword --version=0.18.3

EXPOSE 3000




