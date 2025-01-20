FROM php:8.2-fpm-alpine3.18

RUN apk add --no-cache \
    libzip-dev \
    libpng-dev \
    gmp-dev \
    icu-dev \
    && docker-php-ext-install -j$(nproc) pdo_mysql zip gmp intl

RUN apk add git

RUN curl -sS https://getcomposer.org/installer | php -- --version=2.3.3  --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www

WORKDIR /var/www

USER www-data

CMD php-fpm