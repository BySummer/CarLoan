FROM php:8.2-fpm-alpine3.18

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN apk add --no-cache \
    libzip-dev \
    libpng-dev \
    gmp-dev \
    icu-dev \
    git \
    shadow \
    && docker-php-ext-install pdo pdo_mysql \
    && usermod -u ${USER_ID} www-data \
    && groupmod -g ${GROUP_ID} www-data

RUN curl -sS https://getcomposer.org/installer | php -- --version=2.3.3  --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

USER www-data

CMD php-fpm