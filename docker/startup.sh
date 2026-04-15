#!/bin/bash
set -e

echo "🚀 Starting Sandipan Bhunia Portfolio..."

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
    echo "✅ Application key generated"
else
    echo "✅ Application key already set"
fi

# Show current environment for debugging
echo "📊 Environment Check:"
echo "APP_ENV: $APP_ENV"
echo "DB_CONNECTION: $DB_CONNECTION"
echo "DB_HOST: $DB_HOST"
echo "DB_DATABASE: $DB_DATABASE"

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

# Clear and cache configurations (with error handling)
echo "⚡ Clearing and caching configurations..."
php artisan config:clear || echo "⚠️ Config clear failed, continuing..."
php artisan route:clear || echo "⚠️ Route clear failed, continuing..."
php artisan view:clear || echo "⚠️ View clear failed, continuing..."

php artisan config:cache || echo "⚠️ Config cache failed, continuing..."
php artisan route:cache || echo "⚠️ Route cache failed, continuing..."
php artisan view:cache || echo "⚠️ View cache failed, continuing..."

# Set proper permissions
echo "🔒 Setting permissions..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

echo "✅ Setup complete! Starting Apache..."
exec apache2-foreground