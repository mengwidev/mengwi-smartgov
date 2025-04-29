FROM dunglas/frankenphp:latest

# System dependencies and cleanup
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        zip \
        curl \
        git \
        nano \
        libpq-dev \
        libzip-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libssl-dev \
        libicu-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN install-php-extensions \
        gd \
        intl \
        zip \
        zlib \
        pdo_mysql \
        opcache \
        pcntl \
        redis \
        sockets

# Composer installation
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer \
    --version=2.6.6

# Environment configuration
ENV SERVER_NAME="0.0.0.0:80"
ENV PHP_CLI_SERVER_WORKERS=${PHP_CLI_SERVER_WORKERS:-4}

WORKDIR /app
CMD ["frankenphp", "php-server", "-r", "/app/public"]
