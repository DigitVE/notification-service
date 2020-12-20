FROM php:7.2-apache-stretch

ARG USER_UID
ARG USER_GID
ARG USER_NAME
ARG GROUP_NAME

RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev libpng-dev g++ libfreetype6-dev libjpeg62-turbo-dev librabbitmq4 librabbitmq-dev libssh-dev libxpm-dev libvpx-dev bash openssh-client git \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd \
        --with-freetype-dir=/usr/lib/x86_64-linux-gnu/ \
        --with-jpeg-dir=/usr/lib/x86_64-linux-gnu/ \
        --with-xpm-dir=/usr/lib/x86_64-linux-gnu/ \
    && docker-php-ext-install pdo pdo_mysql zip intl gd bcmath sockets \
    && a2enmod rewrite
RUN pecl install xdebug-beta \
    && pecl install amqp \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-enable amqp \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN if [ "${USER_UID}" != "" ]; \
    then groupadd -g ${USER_GID} ${USER_NAME} \
        && useradd -d "/home/${USER_NAME}" -u ${USER_UID} -g ${USER_GID} -m -s /bin/bash ${USER_NAME}; \
    fi

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV APACHE_RUN_USER ${USER_NAME}
ENV APACHE_RUN_GROUP ${GROUP_NAME}

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
