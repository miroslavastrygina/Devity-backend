FROM php:8.4-fpm

# Установка системных пакетов и зависимостей
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev zip ca-certificates \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl \
    && rm -rf /var/lib/apt/lists/*

# OPcache greatly reduces repeated PHP parsing cost in dev server mode.
RUN { \
    echo "opcache.enable=1"; \
    echo "opcache.enable_cli=1"; \
    echo "opcache.memory_consumption=256"; \
    echo "opcache.interned_strings_buffer=16"; \
    echo "opcache.max_accelerated_files=20000"; \
    echo "opcache.validate_timestamps=1"; \
    echo "opcache.revalidate_freq=2"; \
} > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Только lock-файлы: без полного кода artisan нет — скрипты post-install не запускаем.
COPY composer.json composer.lock ./

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_NO_INTERACTION=1
ENV COMPOSER_PROCESS_TIMEOUT=0

RUN git config --global http.version HTTP/1.1 \
    && git config --global http.postBuffer 524288000 \
    && composer config --global github-protocols https \
    && composer config --global process-timeout 0 \
    && sh -c '\
    for i in 1 2 3 4 5; do \
      echo "composer install: attempt $i of 5..."; \
      composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts && exit 0; \
      echo "composer install: failed, sleeping 45s..."; \
      sleep 45; \
    done; \
    exit 1'

# Весь проект — после этого можно выполнять artisan / скрипты Composer
COPY . .

RUN set -e; \
    composer dump-autoload -o; \
    if [ ! -f .env ]; then cp .env.example .env; fi; \
    php artisan key:generate --force --no-interaction; \
    php artisan package:discover --ansi

RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache
