#! /bin/bash

cd /var/www/docker-symfony

composer install -n --optimize-autoloader

php app/console cache:clear --env=prod --no-debug

chown -R www-data:www-data /tmp/sf2 && chmod -R 770 /tmp/sf2
