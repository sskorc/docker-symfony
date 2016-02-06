FROM sskorc/symfony2-mongo:latest

ADD docker/php.ini.remote /usr/local/etc/php/php.ini

ADD . /var/www/docker-symfony

RUN /var/www/docker-symfony/startup.sh

WORKDIR /var/www/docker-symfony
