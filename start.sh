#!/bin/bash

# Install dependencies
composer install --no-dev --optimize-autoloader
php artisan config:clear

# Laravel setup
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Serve app on Railway's required port
php artisan serve --host=0.0.0.0 --port=8080
