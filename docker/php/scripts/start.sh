#!/bin/bash
php-fpm &
cron -f &
exec /usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
