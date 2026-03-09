#!/bin/bash
set -e

echo "Waiting for MySQL to be ready..."
MAX_RETRIES=30
RETRY=0

while ! mysqladmin ping -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent 2>/dev/null; do
    RETRY=$((RETRY + 1))
    if [ $RETRY -ge $MAX_RETRIES ]; then
        echo "MySQL not ready after $MAX_RETRIES attempts, trying anyway..."
        break
    fi
    echo "MySQL not ready yet... retrying ($RETRY/$MAX_RETRIES)"
    sleep 2
done

echo "Running migrations..."
php artisan config:clear
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
