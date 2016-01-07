FROM php:7-fpm

RUN apt-get update \
    && apt-get install -y git curl bzip2 vim zlib1g-dev \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer
