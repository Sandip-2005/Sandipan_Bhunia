#!/bin/bash

echo "🚀 Starting Sandipan Bhunia Portfolio..."

# Wait for database to be ready
echo "⏳ Waiting for database connection..."
until php artisan migrate:status > /dev/null 2>&1; do
    echo "Database not ready, waiting..."
    sleep 2
done

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Seed database with sample data (only if tables are empty)
echo "🌱 Checking if database needs seeding..."
if [ $(php artisan tinker --execute="echo App\Models\User::count();") -eq 0 ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --class=PortfolioSeeder --force
else
    echo "✅ Database already seeded, skipping..."
fi

echo "🚀 Starting Apache server..."
exec apache2-foreground