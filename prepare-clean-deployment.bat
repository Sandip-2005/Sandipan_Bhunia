@echo off
echo 🚀 Preparing CLEAN Portfolio for InfinityFree Deployment...

REM Create deployment directory
if not exist "deployment-package" mkdir deployment-package
cd deployment-package

echo 📦 Copying only essential files...

REM Copy Laravel core files
robocopy ..\app .\app /E
robocopy ..\bootstrap .\bootstrap /E
robocopy ..\config .\config /E
robocopy ..\database .\database /E /XF database.sqlite
robocopy ..\public .\public /E
robocopy ..\resources .\resources /E
robocopy ..\routes .\routes /E
robocopy ..\storage .\storage /E /XD logs cache sessions views /XF *.log

REM Copy essential root files
copy ..\artisan .\artisan
copy ..\composer.json .\composer.json
copy ..\composer.lock .\composer.lock
copy ..\.env.example .\.env.example
copy ..\.htaccess .\.htaccess
copy ..\deploy.php .\deploy.php

echo 🔧 Setting up production structure...

REM Create necessary directories
if not exist "storage\logs" mkdir storage\logs
if not exist "storage\framework\cache\data" mkdir storage\framework\cache\data
if not exist "storage\framework\sessions" mkdir storage\framework\sessions
if not exist "storage\framework\views" mkdir storage\framework\views
if not exist "public\uploads\projects" mkdir public\uploads\projects
if not exist "public\uploads\skills" mkdir public\uploads\skills
if not exist "public\uploads\profile" mkdir public\uploads\profile

REM Create .gitkeep files
echo. > storage\logs\.gitkeep
echo. > storage\framework\cache\data\.gitkeep
echo. > storage\framework\sessions\.gitkeep
echo. > storage\framework\views\.gitkeep
echo. > public\uploads\projects\.gitkeep
echo. > public\uploads\skills\.gitkeep
echo. > public\uploads\profile\.gitkeep

echo 📝 Creating setup instructions...

echo 🚀 CLEAN Portfolio Deployment Instructions > SETUP_INSTRUCTIONS.txt
echo. >> SETUP_INSTRUCTIONS.txt
echo 1. Upload all files to your InfinityFree public_html directory >> SETUP_INSTRUCTIONS.txt
echo 2. Rename .env.example to .env and configure database settings >> SETUP_INSTRUCTIONS.txt
echo 3. Run: composer install --no-dev --optimize-autoloader >> SETUP_INSTRUCTIONS.txt
echo 4. Run: php artisan key:generate >> SETUP_INSTRUCTIONS.txt
echo 5. Run: php artisan migrate --force >> SETUP_INSTRUCTIONS.txt
echo 6. Run: php artisan db:seed --class=PortfolioSeeder --force >> SETUP_INSTRUCTIONS.txt
echo 7. Run: php artisan config:cache >> SETUP_INSTRUCTIONS.txt
echo 8. Set permissions: chmod -R 755 storage/ bootstrap/cache/ public/uploads/ >> SETUP_INSTRUCTIONS.txt
echo 9. Visit your site and admin panel: /secret-gateway/login >> SETUP_INSTRUCTIONS.txt
echo 10. Default login: admin / portfolio2024 >> SETUP_INSTRUCTIONS.txt

echo ✅ CLEAN deployment package ready!
echo 📁 Files are in: deployment-package\
echo 📋 Read SETUP_INSTRUCTIONS.txt for deployment steps

cd ..
echo 🎯 Ready for clean deployment to InfinityFree!
pause