# 1. Base PHP image with Apache
FROM php:8.2-apache

# 2. Install required system packages
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    mariadb-client nodejs npm

# 3. Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# 4. Enable Apache rewrite
RUN a2enmod rewrite

# 5. Set working directory
WORKDIR /var/www/html

# 6. Copy Laravel files
COPY . .

# 7. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 8. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 9. Install Node dependencies and build assets
RUN npm install && npm run build


# 10. Set correct permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 11. Expose port for Render
EXPOSE 10000

# 12. Start Laravel + run required setup
CMD php artisan config:cache && \
    php artisan migrate --force && \
    php artisan db:seed --force && \
    php artisan storage:link && \
    php artisan serve --host=0.0.0.0 --port=10000
