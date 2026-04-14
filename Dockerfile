# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create a temporary .env file for key generation
RUN cp .env.example .env || echo "APP_KEY=" > .env

# Generate application key
RUN php artisan key:generate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Configure Apache
RUN a2enmod rewrite
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Create uploads directories
RUN mkdir -p /var/www/html/public/uploads/projects \
    && mkdir -p /var/www/html/public/uploads/skills \
    && mkdir -p /var/www/html/public/uploads/profile \
    && chown -R www-data:www-data /var/www/html/public/uploads

# Make startup script executable
RUN chmod +x /var/www/html/docker/startup.sh

# Expose port 80
EXPOSE 80

# Use startup script
CMD ["/var/www/html/docker/startup.sh"]