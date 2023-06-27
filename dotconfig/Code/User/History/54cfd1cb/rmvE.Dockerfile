FROM php:5.6-fpm

RUN docker-php-ext-install pdo_mysql
RUN echo "deb http://archive.debian.org/debian stretch main contrib non-free" > /etc/apt/sources.list \
  && apt-get update \
  && apt-get install -y zlib1g-dev
RUN docker-php-ext-install zip
RUN apt-get update \
  && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd
RUN apt-get install -y libxslt-dev \
  && docker-php-ext-install xsl