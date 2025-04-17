FROM php:8.3-fpm

USER root

RUN apt-get update \
    && apt-get install -y \
    git \
    curl \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zlib1g-dev \
    zip \
    npm \
    unzip \
    libpcre3-dev \
    procps \
    poppler-utils \
    libpng-dev

RUN docker-php-ext-install intl \
    && docker-php-ext-install gd \
    && docker-php-ext-configure gd --enable-gd --with-jpeg \
    && docker-php-ext-enable gd \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install mysqli pdo_mysql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install calendar \
    && docker-php-ext-configure calendar \
    && docker-php-ext-install zip \
    && docker-php-ext-configure zip

RUN pecl install oauth && docker-php-ext-enable oauth

RUN rm -rf /var/cache/apk/*

RUN useradd -ms /bin/sh -u 1001 app
USER app

RUN git config --global --add safe.directory /var/www

WORKDIR /var/www

COPY --chown=app:app . /var/www
