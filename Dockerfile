FROM php:8.4-fpm

# Установка системных пакетов и зависимостей
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev zip \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

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

# Установка рабочего каталога
WORKDIR /var/www

# Копирование файлов проекта
COPY . .

# Установка зависимостей Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Настройка прав
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache
