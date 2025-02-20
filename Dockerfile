# Use PHP 8.1 CLI as the base image
FROM php:8.1-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (PDO and SQLite)
RUN docker-php-ext-install pdo pdo_sqlite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory inside the container
WORKDIR /var/www

# Copy the Laravel project files into the container
COPY . .

# Copy .env.example to .env only if .env does not exist MINE
RUN test -f .env || cp .env.example .env

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate the application key automatically    MINE
RUN php artisan key:generate

# Set appropriate file permissions for Laravel's storage and cache directories MINE
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 8000
EXPOSE 8000

# Start Laravel's built-in server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
