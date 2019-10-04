FROM php:7.3-fpm

ARG PHALCON_VERSION=3.4.4
ARG PHALCON_EXT_PATH=php7/64bits

RUN apt-get update && apt-get install -y \
        apt-utils \
        wget \
        cron \
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
    && docker-php-ext-install -j$(nproc) gd

RUN pecl install xdebug \
		&& echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
		&& echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
		&& echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
		&& echo "xdebug.remote_port=10000" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN git clone https://github.com/jbboehr/php-psr.git \
    && cd php-psr \
    && phpize \
    && ./configure \
    && make \
    && make test \
    && make install \
    && echo "extension=$(find /usr/local/lib/php/extensions/ -name psr.so)" > /usr/local/etc/php/conf.d/psr.ini

RUN git clone git://github.com/phalcon/php-zephir-parser.git \
    && cd php-zephir-parser \
    && phpize \
    && ./configure \
    && make \
    && make install \
    && echo "extension=$(find /usr/local/lib/php/extensions/ -name zephir_parser.so)" > /usr/local/etc/php/conf.d/zephir_parser.ini

RUN git clone https://github.com/phalcon/cphalcon \
    && cd cphalcon \
    && wget "https://github.com/phalcon/zephir/releases/download/0.12.4/zephir.phar" \
    && php zephir.phar fullclean \
    && php zephir.phar build \
    && echo "extension=$(find /usr/local/lib/php/extensions/ -name phalcon.so)" > /usr/local/etc/php/conf.d/phalcon.ini

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini
WORKDIR /var/server

CMD ["php-fpm"]