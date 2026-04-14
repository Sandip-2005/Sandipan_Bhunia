@echo off
echo 🚀 Preparing Portfolio for InfinityFree Deployment...

REM Create deployment directory
if not exist "deployment-package" mkdir deployment-package
cd deployment-package

echo 📦 Copying necessary files...

REM Copy files (excluding unnecessary directories)
robocopy ..\ .\ /E /XD node_modules vendor .git deployment-package storage\logs storage\framework\cache storage\framework\sessions storage\framework\views /XF .env

echo 🔧 Setting up production configuration...

REM Copy production environment template
copy ..\env.production .env.example

REM Create necessary directories
if not exist "storage\logs" mkdir storage\logs
if not exist "storage\framework\cache\data" mkdir storage\framework\cache\data
if not exist "storage\framework\sessions" mkdir storage\framework\sessions
if not exist "storage\framework\views" mkdir storage\framework\views
if not exist "public\uploads\projects" mkdir public\uploads\projects
if not exist "public\uploads\skills" mkdir public\uploads\skills
if not exist "public\uploads\profile" mkdir public\uploads\profile

REM Create empty files for directories
echo. > storage\logs\.gitkeep
echo. > storage\framework\cache\data\.gitkeep
echo. > storage\framework\sessions\.gitkeep
echo. > storage\framework\views\.gitkeep
echo. > public\uploads\projects\.gitkeep
echo. > public\uploads\skills\.gitkeep
echo. > public\uploads\profile\.gitkeep

echo 📝 Creating deployment instructions...

echo 🚀 InfinityFree Deployment Instructions > DEPLOYMENT_INSTRUCTIONS.txt
echo. >> DEPLOYMENT_INSTRUCTIONS.txt
echo 1. UPLOAD FILES: >> DEPLOYMENT_INSTRUCTIONS.txt
echo    - Upload all files in this directory to your InfinityFree public_html folder >> DEPLOYMENT_INSTRUCTIONS.txt
echo    - Make sure .htaccess is in the root directory >> DEPLOYMENT_INSTRUCTIONS.txt
echo. >> DEPLOYMENT_INSTRUCTIONS.txt
echo 2. SETUP DATABASE: >> DEPLOYMENT_INSTRUCTIONS.txt
echo    - Create MySQL database in InfinityFree control panel >> DEPLOYMENT_INSTRUCTIONS.txt
echo    - Note down database name, username, and password >> DEPLOYMENT_INSTRUCTIONS.txt
echo. >> DEPLOYMENT_INSTRUCTIONS.txt
echo 3. CONFIGURE ENVIRONMENT: >> DEPLOYMENT_INSTRUCTIONS.txt
echo    - Rename .env.example to .env >> DEPLOYMENT_INSTRUCTIONS.txt
echo    - Update database credentials in .env file >> DEPLOYMENT_INSTRUCTIONS.txt
echo    - Generate new APP_KEY: php artisan key:generate >> DEPLOYMENT_INSTRUCTIONS.txt
echo. >> DEPLOYMENT_INSTRUCTIONS.txt
echo 4. SET PERMISSIONS: >> DEPLOYMENT_INSTRUCTIONS.txt
echo    chmod -R 755 storage/ >> DEPLOYMENT_INSTRUCTIONS.txt
echo    chmod -R 755 bootstrap/cache/ >> DEPLOYMENT_INSTRUCTIONS.txt
echo    chmod -R 755 public/uploads/ >> DEPLOYMENT_INSTRUCTIONS.txt
echo. >> DEPLOYMENT_INSTRUCTIONS.txt
echo 5. INSTALL ^& SETUP: >> DEPLOYMENT_INSTRUCTIONS.txt
echo    composer install --no-dev --optimize-autoloader >> DEPLOYMENT_INSTRUCTIONS.txt
echo    php artisan migrate --force >> DEPLOYMENT_INSTRUCTIONS.txt
echo    php artisan db:seed --class=PortfolioSeeder --force >> DEPLOYMENT_INSTRUCTIONS.txt
echo    php artisan config:cache >> DEPLOYMENT_INSTRUCTIONS.txt
echo    php artisan route:cache >> DEPLOYMENT_INSTRUCTIONS.txt
echo    php artisan view:cache >> DEPLOYMENT_INSTRUCTIONS.txt
echo. >> DEPLOYMENT_INSTRUCTIONS.txt
echo 6. TEST: >> DEPLOYMENT_INSTRUCTIONS.txt
echo    - Visit your website >> DEPLOYMENT_INSTRUCTIONS.txt
echo    - Login to admin: your-domain.com/secret-gateway/login >> DEPLOYMENT_INSTRUCTIONS.txt
echo    - Default credentials: admin / portfolio2024 >> DEPLOYMENT_INSTRUCTIONS.txt
echo. >> DEPLOYMENT_INSTRUCTIONS.txt
echo 🎉 Your portfolio is now live! >> DEPLOYMENT_INSTRUCTIONS.txt

echo ✅ Deployment package ready!
echo 📁 Files are in: deployment-package\
echo 📋 Read DEPLOYMENT_INSTRUCTIONS.txt for next steps

cd ..
echo 🎯 Ready for deployment to InfinityFree!
pause