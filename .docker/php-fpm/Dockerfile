FROM php:8.0-fpm as scratch

ARG APP_ENV
ENV APP_ENV=${APP_ENV}
ENV TZ=Europe/Kiev

# Add php config
COPY .docker/php-fpm/php_${APP_ENV}.ini /usr/local/etc/php/php.ini
COPY .docker/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN apt-get update && apt-get install -y git git-core \
    wget \
    unzip \
    libonig-dev \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libz-dev \
    libmemcached-dev \
    libmemcached-tools \
    && docker-php-ext-install pdo pdo_mysql mysqli intl pcntl mbstring bcmath zip soap \
    && pecl install memcached \
    && docker-php-ext-enable mysqli memcached \

    # MAKE tmp WRITABLE
    && chmod 777 -R /tmp && chmod o+t -R /tmp \
    && wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/bin --filename=composer --quiet \
    && echo 'alias bc="php bin/console"' >> ~/.bashrc \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \

    # Чистим временные файлы
    && apt-get autoremove --purge -y && apt-get autoclean -y && apt-get clean -y \
    && pecl clear-cache \
    && docker-php-source delete

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www/html

# DEV env (local)
FROM scratch as dev

RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# PROD env (kubernetes)
FROM scratch as prod

USER www-data:www-data
CMD ["php-fpm"]
EXPOSE 9000