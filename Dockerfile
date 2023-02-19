FROM php:8.1-fpm-alpine3.17
MAINTAINER pysga1996
WORKDIR /var/www/html

RUN apk update && apk --no-cache --update add \
        busybox-extras \
        linux-headers \
        autoconf \
        gcc \
        g++ \
        make \
        nodejs \
        npm \
        libpng-dev \
#        zlib1g-dev \
        zlib-dev \
        libxml2-dev \
        libzip-dev \
#        libonig-dev \
        oniguruma-dev \
        zip \
        curl \
        unzip \
        libpq-dev \
        openrc \
        nginx \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
#    && docker-php-ext-install pdo_mysql \
#    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install pgsql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-source delete \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rc-update add nginx default

COPY package.json /var/www/html/package.json
COPY composer.json /var/www/html/composer.json

# cached
RUN npm install \
    && composer install --no-dev --no-scripts

COPY . /var/www/html/
RUN composer dump-autoload \
    && php artisan key:generate \
    && php artisan config:clear \
    && php artisan config:cache \
    && chown -R www-data:www-data /var/www/html/storage \
                    /var/www/html/bootstrap/cache

COPY ./server/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./server/nginx.conf /etc/nginx/http.d/default.conf
COPY ./server/entrypoint.sh /etc/entrypoint.sh

ENTRYPOINT ["sh", "/etc/entrypoint.sh"]
EXPOSE 80
