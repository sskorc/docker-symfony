FROM php:5.6-apache

RUN apt-get update \
    && apt-get install -y git libssl-dev zlib1g-dev libicu-dev g++ \
    && pecl install mongo \
    && echo extension=mongo.so > /usr/local/etc/php/conf.d/mongo.ini \
    && pecl install xdebug \
    && echo zend_extension=xdebug.so > /usr/local/etc/php/conf.d/xdebug.ini \
    && pecl install apcu-beta \
    && echo extension=apcu.so > /usr/local/etc/php/conf.d/apcu.ini \
    && docker-php-ext-install zip mbstring intl

# workaround until https://github.com/boot2docker/boot2docker/issues/581 is fixed
RUN echo 'IncludeOptional sites-enabled/*.conf' >> /etc/apache2/apache2.conf

ADD docker/vhost.conf /etc/apache2/sites-enabled/000-default.conf
ADD docker/php.ini /usr/local/etc/php/php.ini

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer

WORKDIR /var/www/docker-symfony
