FROM php:7.2-fpm
MAINTAINER d0kur0

RUN apt-get update && apt-get install -y \
        apt-utils \
        wget \
        libfreetype6-dev \
        gcc \
        build-essential \
        make \
        automake \
        autoconf \
        libjpeg62-turbo-dev \
        git \
        libpcre3 \
        re2c \
        libpng-dev \
        libcurl4-openssl-dev \
        pkg-config \
        libssl-dev \
    && docker-php-ext-install -j$(nproc) iconv pdo_mysql \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini
WORKDIR /var/server

CMD ["php-fpm"]