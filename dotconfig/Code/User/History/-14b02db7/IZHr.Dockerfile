FROM php:5.6-fpm
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir /app/public/phpWord

WORKDIR /app/public/phpWord

COPY index.php .
COPY resources .

RUN php composer install phpoffice/phpword --version=0.18.3 --install-dir=

RUN docker-php-ext-install pdo_mysql



