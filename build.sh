#!/bin/bash

echo "🚀 Building Sandipan Bhunia Portfolio for Render..."

# Wait for database to be ready
echo "⏳ Waiting for database connection..."
until php artisan migrate:status > /dev/null 2>&1; do
    echo "Database not ready, waiting..."
    sleep 2
done

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Seed database with sample data
echo "🌱 Seeding database..."
php artisan db:seed --class=PortfolioSeeder --force

echo "✅ Database setup completed successfully!"