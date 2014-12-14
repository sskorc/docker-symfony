FROM ubuntu:utopic

### Repositories & Keys

RUN apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 7F0CEB10
RUN echo 'deb http://downloads-distro.mongodb.org/repo/ubuntu-upstart dist 10gen' | sudo tee /etc/apt/sources.list.d/mongodb.list

RUN apt-get update

### General system configuration

RUN locale-gen en_US.UTF-8

### SSH

RUN apt-get install -y openssh-server

RUN mkdir -p /var/run/sshd
RUN echo 'root:symfony' | chpasswd
RUN sed -i 's/PermitRootLogin without-password/PermitRootLogin yes/' /etc/ssh/sshd_config

### Supervisor

RUN apt-get install -y supervisor

RUN mkdir -p /var/log/supervisor

ADD docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

### MongoDB

RUN apt-get install -y mongodb-org
RUN mkdir -p /data/db

### PHP & Apache2

RUN apt-get install -y apache2 zip curl git acl php5-curl php5-cli php5-json php5-intl php5 libapache2-mod-php5 php5-mongo
ADD docker/vhost.conf /etc/apache2/sites-enabled/000-default.conf
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
RUN a2enmod rewrite

RUN sed -i "s/;date.timezone =/date.timezone = Europe\/Warsaw/" /etc/php5/apache2/php.ini

### Composer

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer

### RUN

EXPOSE 22 80 27017

CMD supervisord -c /etc/supervisor/conf.d/supervisord.conf
