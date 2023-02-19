#!/usr/bin/env bash
set -e
echo "* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1" >> /var/spool/cron/crontabs/root
crond -b
php-fpm -D
nginx -g 'daemon off;'
