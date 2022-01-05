FROM php:5.6-fpm-stretch
LABEL maintainer="Jesus Fernandez"

COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/composer-installer.sh /usr/local/bin/composer-installer

# Install packages
RUN apt-get update && apt-get install -yqq \
    pdftk \
    qpdf \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libzip-dev \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++ \
    vim \
    htop \
    libssl-dev

# Common PHP Extensions
RUN docker-php-ext-install \
    bz2 \
    intl \
    iconv \
    bcmath \
    gd \
    calendar \
    zip \
    pdo_mysql \
    mbstring \
    tokenizer

RUN chmod +x /usr/local/bin/composer-installer \
    && composer-installer \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer \
    && composer --version \
    && echo 'root' > /etc/cron.allow \
    && chmod -R ugo-w /usr/local/lib/php
