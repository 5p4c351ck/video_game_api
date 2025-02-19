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

# Install Composer 2.6
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set the working directory inside the container
WORKDIR /var/www

# Copy the Laravel project files into the container
COPY . .

# Install Laravel dependencies
RUN composer install

# Expose port 8000
EXPOSE 8000

# Start Laravel's built-in server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
