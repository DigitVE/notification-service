FROM php:7.3-apache-stretch

RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev libpng-dev g++ libfreetype6-dev libjpeg62-turbo-dev \
    libxpm-dev libvpx-dev bash openssh-client git libzip-dev && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr/lib/x86_64-linux-gnu/ \
        --with-jpeg-dir=/usr/lib/x86_64-linux-gnu/ \
        --with-xpm-dir=/usr/lib/x86_64-linux-gnu/ \
    && docker-php-ext-install pdo pdo_mysql zip intl gd sockets \
    && a2enmod rewrite headers

ENV LOG_CHANNEL=stderr

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

VOLUME /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /var/www/tmp
RUN cd /var/www/tmp && composer install --no-dev && composer dump-autoload

RUN chmod +x /var/www/tmp/docker-entrypoint.sh
ENTRYPOINT ["/var/www/tmp/docker-entrypoint.sh"]

CMD php artisan notifications:pull
