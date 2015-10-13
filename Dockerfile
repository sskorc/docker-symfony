FROM sskorc/symfony2-mongo:latest

ADD docker/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/docker-symfony
