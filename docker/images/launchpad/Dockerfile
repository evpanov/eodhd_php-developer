FROM php:7.4.33-cli

RUN apt-get update -yqq && apt-get upgrade -yqq
RUN apt-get install -yqq \
    supervisor gnupg git wget curl libzip-dev zip

RUN docker-php-ext-install \
    zip

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u 1000 www-data

WORKDIR /opt/app

CMD ["/usr/bin/supervisord"]