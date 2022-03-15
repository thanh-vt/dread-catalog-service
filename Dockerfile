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
    && docker-php-source delete

COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

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
