#!/usr/bin/env bash
set -e

/etc/init.d/cron start
apache2-foreground
