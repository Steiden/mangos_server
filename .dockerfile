# Используем официальный образ PHP с Apache
FROM php:8.2-apache

# Устанавливаем необходимые пакеты
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем файлы проекта
COPY . .

# Устанавливаем зависимости
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Настройка Apache
COPY docker/apache/default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Копируем файлы .htaccess
# COPY .htaccess public/

# Устанавливаем права доступа
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Очистка кеша
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache