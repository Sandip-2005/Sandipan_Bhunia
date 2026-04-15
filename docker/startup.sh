#!/bin/bash
set -e

echo "🚀 Starting Sandipan Bhunia Portfolio..."

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Test database connection with proper error handling
echo "⏳ Testing database connection..."
if ! php artisan migrate:status > /dev/null 2>&1; then
    echo "⚠️ Database not immediately available, trying to connect..."
    
    # Try to run migrations directly (this will create tables if they don't exist)
    echo "🗄️ Running database migrations..."
    if php artisan migrate --force; then
        echo "✅ Database migrations completed successfully"
    else
        echo "❌ Database migration failed, but continuing..."
    fi
else
    echo "✅ Database connection successful"
    echo "🗄️ Running database migrations..."
    php artisan migrate --force
fi

# Seed database (with error handling)
echo "🌱 Seeding database..."
if php artisan db:seed --class=PortfolioSeeder --force; then
    echo "✅ Database seeded successfully"
else
    echo "⚠️ Database seeding failed or already exists, continuing..."
fi

# Cache configurations (with error handling)
echo "⚡ Caching configurations..."
php artisan config:cache || echo "⚠️ Config cache failed, continuing..."
php artisan route:cache || echo "⚠️ Route cache failed, continuing..."
php artisan view:cache || echo "⚠️ View cache failed, continuing..."

echo "✅ Setup complete! Starting Apache..."
exec apache2-foreground