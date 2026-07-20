#!/bin/bash
set -e

# Set Apache listening port dynamically based on Render's $PORT env variable
if [ -n "$PORT" ]; then
    echo "Configuring Apache to listen on port $PORT..."
    sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
    sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$PORT>/g" /etc/apache2/sites-available/000-default.conf
fi

# Optimize Laravel configurations for production
echo "Caching Laravel configuration, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations if database is ready and RUN_MIGRATIONS is set to true
if [ "${RUN_MIGRATIONS}" = "true" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

# Execute the default command (Apache)
exec "$@"
