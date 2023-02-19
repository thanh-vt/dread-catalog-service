#!/usr/bin/env bash
set -e

crond -b
php-fpm -D
nginx -g 'daemon off;'
