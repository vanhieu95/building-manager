#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

echo "Generate new app key"
php artisan key:generate

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Create the symbolic links configured for the application"
php artisan storage:link

echo "Running migrations..."
php artisan migrate:fresh --force
