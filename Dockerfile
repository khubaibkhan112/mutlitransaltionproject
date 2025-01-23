# Use the official PHP image with required extensions
FROM php:8.2-fpm

# Set the working directory
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . /var/www

# Set permissions
RUN chown -R www-data:www-data /var/www

# Expose port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
