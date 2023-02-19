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
    && echo "* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1" >> /var/spool/cron/crontabs/root

COPY package.json /var/www/html/package.json
COPY composer.json /var/www/html/composer.json

# cached
RUN npm install \
    && composer install --no-dev --no-scripts

COPY . /var/www/html/
RUN composer dump-autoload \
    && php artisan key:generate \
#    && php artisan cache:clear \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && chown -R www-data:www-data /var/www/html/storage \
        /var/www/html/bootstrap/cache

COPY ./server/php/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./server/php/error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini
COPY ./server/nginx/nginx.conf /etc/nginx/http.d/default.conf
COPY ./server/nginx/entrypoint.sh /etc/entrypoint.sh

ENTRYPOINT ["sh", "/etc/entrypoint.sh"]
EXPOSE 80
