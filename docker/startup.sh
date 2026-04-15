#!/bin/bash
set -e

echo "🚀 Starting Sandipan Bhunia Portfolio..."

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Wait for database (with timeout)
echo "⏳ Waiting for database connection..."
timeout=60
counter=0
until php artisan migrate:status > /dev/null 2>&1; do
    if [ $counter -ge $timeout ]; then
        echo "❌ Database connection timeout after ${timeout}s"
        exit 1
    fi
    echo "Database not ready, waiting... ($counter/${timeout}s)"
    sleep 2
    counter=$((counter + 2))
done

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Seed database (simplified check)
echo "🌱 Seeding database..."
php artisan db:seed --class=PortfolioSeeder --force || echo "⚠️ Seeding skipped (may already exist)"

# Cache configurations
echo "⚡ Caching configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Setup complete! Starting Apache..."
exec apache2-foreground