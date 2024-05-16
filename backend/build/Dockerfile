FROM php:8.3-cli-bookworm AS composer
ENV APP_ENV prod
ENV DEBIAN_FRONTEND noninteractive
ENV PROJECT_DIR /var/www/project
ENV COMPOSER_ALLOW_SUPERUSER 1
WORKDIR $PROJECT_DIR
RUN apt-get update \
 && apt-get install -y --no-install-recommends git libzip-dev unzip zlib1g-dev \
 && docker-php-ext-install zip
RUN curl --silent --show-error https://getcomposer.org/installer | php
COPY . $PROJECT_DIR
RUN touch .env && php composer.phar install --audit --no-dev --no-interaction --prefer-dist

FROM php:8.3-apache-bookworm
ENV APP_ENV prod
ENV DEBIAN_FRONTEND noninteractive
ENV PROJECT_DIR /var/www/project
WORKDIR $PROJECT_DIR
RUN docker-php-ext-install pdo pdo_mysql \
 && sed -i "s|DocumentRoot /var/www/html|DocumentRoot $PROJECT_DIR/public|" /etc/apache2/sites-available/000-default.conf \
 && cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
 && sed -i "s/variables_order = \"GPCS\"/variables_order = \"EGPCS\"/g" /usr/local/etc/php/php.ini \
 && sed -i "s/expose_php = On/expose_php = Off/g" /usr/local/etc/php/php.ini \
 && sed -i "s/memory_limit = 128M/memory_limit = 512M/g" /usr/local/etc/php/php.ini \
 && sed -i "s/ServerTokens OS/ServerTokens Prod/g" /etc/apache2/conf-available/security.conf \
 && sed -i "s/ServerSignature On/ServerSignature Off/g" /etc/apache2/conf-available/security.conf \
 && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

COPY --from=composer --chown=www-data:www-data $PROJECT_DIR $PROJECT_DIR
