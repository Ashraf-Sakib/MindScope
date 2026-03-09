FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libcurl4-openssl-dev default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring xml curl ctype \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy the rest of the application
COPY . .

# Run post-install scripts
RUN composer dump-autoload --optimize

# Set permissions
RUN chmod -R 775 storage bootstrap/cache
RUN chmod +x docker-entrypoint.sh

# Expose port
EXPOSE 8080

# Start: wait for DB, migrate, then serve
CMD ["bash", "docker-entrypoint.sh"]
