FROM php:latest

RUN apt update && apt install -y zip curl git nano libpq-dev libzip-dev libjpeg-dev libpng-dev libfreetype6-dev

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd intl zip zlib pdo_pgsql pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV SERVER_NAME="0.0.0.0:80"

WORKDIR /var/www/

ENTRYPOINT ["php", "-S", "0.0.0.0:80", "-t", "public"]
