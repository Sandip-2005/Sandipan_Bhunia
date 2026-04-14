#!/bin/bash

# Portfolio Deployment Preparation Script
# This script prepares your Laravel portfolio for InfinityFree deployment

echo "🚀 Preparing Portfolio for InfinityFree Deployment..."

# Create deployment directory
mkdir -p deployment-package
cd deployment-package

echo "📦 Copying necessary files..."

# Copy Laravel files (excluding unnecessary directories)
rsync -av --exclude='node_modules' \
          --exclude='vendor' \
          --exclude='.git' \
          --exclude='storage/logs/*' \
          --exclude='storage/framework/cache/*' \
          --exclude='storage/framework/sessions/*' \
          --exclude='storage/framework/views/*' \
          --exclude='.env' \
          --exclude='deployment-package' \
          ../ ./

echo "🔧 Setting up production configuration..."

# Copy production environment template
cp ../.env.production .env.example

# Create necessary directories
mkdir -p storage/logs
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p public/uploads/projects
mkdir -p public/uploads/skills
mkdir -p public/uploads/profile

# Create empty files for directories
touch storage/logs/.gitkeep
touch storage/framework/cache/data/.gitkeep
touch storage/framework/sessions/.gitkeep
touch storage/framework/views/.gitkeep
touch public/uploads/projects/.gitkeep
touch public/uploads/skills/.gitkeep
touch public/uploads/profile/.gitkeep

echo "📝 Creating deployment instructions..."

cat > DEPLOYMENT_INSTRUCTIONS.txt << 'EOF'
🚀 InfinityFree Deployment Instructions

1. UPLOAD FILES:
   - Upload all files in this directory to your InfinityFree public_html folder
   - Make sure .htaccess is in the root directory

2. SETUP DATABASE:
   - Create MySQL database in InfinityFree control panel
   - Note down database name, username, and password

3. CONFIGURE ENVIRONMENT:
   - Rename .env.example to .env
   - Update database credentials in .env file
   - Generate new APP_KEY: php artisan key:generate

4. SET PERMISSIONS:
   chmod -R 755 storage/
   chmod -R 755 bootstrap/cache/
   chmod -R 755 public/uploads/

5. INSTALL & SETUP:
   composer install --no-dev --optimize-autoloader
   php artisan migrate --force
   php artisan db:seed --class=PortfolioSeeder --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache

6. SETUP AUTO-DEPLOYMENT (Optional):
   - Edit deploy.php with your GitHub repository details
   - Set up GitHub webhook pointing to your-domain.com/deploy.php
   - Use a secure secret key for webhook authentication

7. TEST:
   - Visit your website
   - Login to admin: your-domain.com/secret-gateway/login
   - Default credentials: admin / portfolio2024

🎉 Your portfolio is now live!
EOF

echo "✅ Deployment package ready!"
echo "📁 Files are in: deployment-package/"
echo "📋 Read DEPLOYMENT_INSTRUCTIONS.txt for next steps"

# Create a zip file for easy upload
if command -v zip &> /dev/null; then
    echo "📦 Creating zip file for easy upload..."
    zip -r ../portfolio-deployment.zip . -x "*.DS_Store" "*.git*"
    echo "✅ Created: portfolio-deployment.zip"
fi

cd ..
echo "🎯 Ready for deployment to InfinityFree!"