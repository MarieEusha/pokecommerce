FROM php:8.1-fpm-alpine as prod
ARG TIMEZONE

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

# Réglage de la timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

# Librairies requises pour Symfony
RUN apk add --update icu icu-dev openldap-dev libldap zlib-dev libzip-dev libxml2-dev nodejs npm git gmp-dev \
    && docker-php-ext-install pdo_mysql zip intl opcache pdo pdo_mysql gmp sockets

# Configuration spécifique pour Symfony
RUN echo "realpath_cache_size=4096K" >> /usr/local/etc/php/conf.d/symfony.ini \
&& echo "realpath_cache_ttl=600" >> /usr/local/etc/php/conf.d/symfony.ini \
&& echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/symfony.ini \
&& echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/symfony.ini \
&& echo "upload_max_filesize=100M" >> /usr/local/etc/php/conf.d/symfony.ini \
&& echo "post_max_size=100M" >> /usr/local/etc/php/conf.d/symfony.ini

# Installation de yarn (webpack)
RUN curl -o- -L https://yarnpkg.com/install.sh | /bin/sh \
&& ln -s /root/.yarn/bin/yarn /usr/local/bin/yarn

WORKDIR /var/www/symfony

FROM prod as dev

RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && architecture=$(uname -m) \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/alpine/$architecture/$version \
    && mkdir -p /tmp/blackfire \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp/blackfire \
    && mv /tmp/blackfire/blackfire-*.so $(php -r "echo ini_get ('extension_dir');")/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8307\n" > $PHP_INI_DIR/conf.d/blackfire.ini \
    && rm -rf /tmp/blackfire /tmp/blackfire-probe.tar.gz