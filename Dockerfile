FROM php:cli

COPY . /var/www
WORKDIR /var/www

RUN apt-get update
RUN apt-get install --reinstall -y --force-yes ca-certificates
RUN apt-get install -y --force-yes zip unzip libzip-dev git
RUN docker-php-ext-install zip pcntl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install
