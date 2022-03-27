FROM php:8.1-apache

WORKDIR /var/www/html

COPY . /var/www/html/

RUN apt update && apt install -y \
        nodejs \
        npm \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
        libpq-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
#    && docker-php-ext-install pdo_mysql \
#    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install pgsql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
	&& echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && docker-php-source delete

COPY ./server/vhost.conf /etc/apache2/sites-available/000-default.conf
#COPY ./server/error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini
#COPY ./server/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

#RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
#    && php composer-setup.php \
#    && php -r "unlink('composer-setup.php');" \
#    && php composer.phar install --no-dev --no-scripts \
#    && rm composer.phar

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#RUN composer install --no-dev --no-scripts

RUN composer dump-autoload

RUN chown -R www-data:www-data /var/www/html/storage \
        /var/www/html/bootstrap/cache && a2enmod rewrite

RUN php artisan key:generate
RUN php artisan config:clear
RUN php artisan config:cache

VOLUME /var/www/html
EXPOSE 80 443
