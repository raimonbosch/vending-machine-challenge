FROM php:8.4-fpm

RUN apt-get -y update

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get install -y libicu-dev \
    && docker-php-ext-install intl

RUN apt-get -y install npm \
    && apt-get -y install jest

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer