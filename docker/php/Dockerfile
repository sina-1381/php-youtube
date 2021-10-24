FROM php:7.4.24-fpm-alpine3.14

RUN mkdir -p /var/www/html
WORKDIR /var/www/html

ENV php_conf /usr/local/etc/php-fpm.conf
ENV fpm_conf /usr/local/etc/php-fpm.d/www.conf
ENV php_vars /usr/local/etc/php/conf.d/docker-vars.ini


# resolves #166
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php
RUN apk add --no-cache --repository http://dl-3.alpinelinux.org/alpine/edge/community gnu-libiconv \
    && apk add --no-cache --virtual .build-deps \
    autoconf \
    gcc \
    libc-dev \
    make \
    curl \
    gd-dev
RUN echo @testing http://nl.alpinelinux.org/alpine/edge/testing >> /etc/apk/repositories && \
    echo /etc/apk/respositories && \
    apk update && apk upgrade &&\
    apk add --no-cache \
    bash \
    wget \
    supervisor \
    curl \
    libcurl \
    oniguruma-dev \
    libzip-dev \
    bzip2-dev \
    autoconf \
    libmcrypt-dev \
    libxml2-dev \
    make \
    postgresql-dev && \
    docker-php-ext-configure gd \
      --with-freetype \
      --with-jpeg && \
    #curl iconv session
    #docker-php-ext-install pdo_mysql pdo_sqlite mysqli mcrypt gd exif intl xsl json soap dom zip opcache && \
    docker-php-ext-install pdo_mysql zip exif pcntl iconv pdo_pgsql gd soap mbstring
RUN pecl install xdebug \
        && docker-php-ext-enable xdebug

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN pecl install -o -f mcrypt \
    && docker-php-ext-enable mcrypt
RUN docker-php-source delete && \
    mkdir -p /run/nginx && \
    mkdir -p /var/log/supervisor && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --quiet --install-dir=/usr/bin --filename=composer && \
    rm composer-setup.php && \
    mkdir -p /etc/letsencrypt/webrootauth && \
    apk del gcc musl-dev linux-headers libffi-dev augeas-dev python3-dev make autoconf

RUN echo "cgi.fix_pathinfo=0" > ${php_vars} &&\
    echo "upload_max_filesize = 100M"  >> ${php_vars} &&\
    echo "post_max_size = 100M"  >> ${php_vars} &&\
    echo "variables_order = \"EGPCS\""  >> ${php_vars} && \
    echo "memory_limit = 128M"  >> ${php_vars}

# Add user for laravel application
RUN addgroup -S www
RUN adduser -G www -g "" -s /bin/sh -D www
RUN echo "www ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

ADD ./docker/php/supervisor/conf.d /etc/supervisor
# Copy existing application directory content
ADD ./src /var/www/html

RUN chown -R www:www /var/www

ADD ./docker/php/scripts/start.sh /start.sh
RUN chmod +x /start.sh

# Add crontab file
COPY ./docker/php/crontab /etc/cron.d/crontab

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/crontab

# Apply cron job
RUN crontab /etc/cron.d/crontab

# Create the log file to be able to run tail
RUN touch /var/log/cron.log


EXPOSE 9000

CMD ["/start.sh"]

