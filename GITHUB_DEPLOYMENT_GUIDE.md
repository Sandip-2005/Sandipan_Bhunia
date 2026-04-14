# 🚀 GitHub + InfinityFree Auto-Deployment Setup

This guide will help you set up automatic deployment from GitHub to InfinityFree, so every time you push code to GitHub, it automatically updates your live website.

## 📋 Prerequisites

- GitHub account with your portfolio repository
- InfinityFree hosting account
- Basic knowledge of Git commands

## 🔧 Step 1: Prepare Your Repository

### 1.1 Initialize Git Repository (if not done)
```bash
git init
git add .
git commit -m "Initial portfolio commit"
git branch -M main
git remote add origin https://github.com/yourusername/your-portfolio.git
git push -u origin main
```

### 1.2 Create Production Environment File
Copy `.env.production` to `.env` on your server and update:
```env
APP_URL=https://yourdomain.infinityfreeapp.com
DB_HOST=sql123.infinityfree.com
DB_DATABASE=if0_12345678_portfolio
DB_USERNAME=if0_12345678
DB_PASSWORD=your_actual_password
```

## 🌐 Step 2: InfinityFree Setup

### 2.1 Create Database
1. Login to InfinityFree Control Panel
2. Go to **MySQL Databases**
3. Create new database: `portfolio`
4. Note down the database details

### 2.2 Upload Files
Upload these files to your `public_html` directory:
- All Laravel files (except `vendor/`, `node_modules/`, `.git/`)
- `.htaccess` (root directory configuration)
- `deploy.php` (auto-deployment script)

### 2.3 Set File Permissions
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod -R 755 public/uploads/
chmod 644 .env
```

### 2.4 Install Dependencies & Setup
```bash
# Install Composer dependencies
composer install --no-dev --optimize-autoloader

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Seed sample data
php artisan db:seed --class=PortfolioSeeder --force

# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔗 Step 3: GitHub Webhook Setup

### 3.1 Configure Deploy Script
1. Edit `deploy.php` on your server:
```php
$secret = 'your-super-secret-webhook-key'; // Generate a random string
$repo_path = '/home/vol4_1/infinityfree.com/if0_XXXXXXXX/htdocs'; // Your actual path
$github_repo = 'https://github.com/yourusername/portfolio.git'; // Your repo URL
```

### 3.2 Create GitHub Webhook
1. Go to your GitHub repository
2. Click **Settings** → **Webhooks** → **Add webhook**
3. Configure:
   - **Payload URL**: `https://yourdomain.infinityfreeapp.com/deploy.php`
   - **Content type**: `application/json`
   - **Secret**: Use the same secret from `deploy.php`
   - **Events**: Select "Just the push event"
   - **Active**: ✅ Checked

### 3.3 Test the Webhook
1. Make a small change to your code
2. Commit and push:
```bash
git add .
git commit -m "Test auto-deployment"
git push origin main
```
3. Check `deploy.log` on your server for deployment status

## 📁 Step 4: Directory Structure on InfinityFree

```
public_html/
├── .htaccess                 # Server configuration
├── deploy.php               # Auto-deployment script
├── deploy.log              # Deployment logs
├── .env                    # Environment configuration
├── app/                    # Laravel app directory
├── bootstrap/              # Laravel bootstrap
├── config/                 # Laravel config
├── database/               # Migrations & seeders
├── public/                 # Public assets
│   ├── index.php          # Laravel entry point
│   └── uploads/           # User uploads
├── resources/             # Views & assets
├── routes/                # Route definitions
├── storage/               # Laravel storage
└── vendor/                # Composer dependencies
```

## 🔄 Step 5: Deployment Workflow

### Automatic Deployment Process:
1. **You push code** to GitHub
2. **GitHub webhook** triggers `deploy.php`
3. **Server pulls** latest code from GitHub
4. **Composer installs** dependencies
5. **Laravel optimizes** for production
6. **File permissions** are set correctly
7. **Your site is updated** automatically!

### Manual Commands (if needed):
```bash
# Pull latest changes
git pull origin main

# Update dependencies
composer install --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force

# Clear and cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🛡️ Step 6: Security & Best Practices

### 6.1 Environment Security
- Never commit `.env` to GitHub
- Use strong database passwords
- Keep webhook secret secure
- Set `APP_DEBUG=false` in production

### 6.2 File Security
```apache
# .htaccess rules already included for:
# - Blocking access to .env
# - Preventing directory listing
# - Security headers
# - Asset caching
```

### 6.3 Backup Strategy
```bash
# Create database backup
mysqldump -u username -p database_name > backup.sql

# Backup uploaded files
tar -czf uploads_backup.tar.gz public/uploads/
```

## 📊 Step 7: Monitoring & Maintenance

### 7.1 Check Deployment Logs
```bash
# View recent deployments
tail -f deploy.log

# Check Laravel logs
tail -f storage/logs/laravel.log
```

### 7.2 Performance Monitoring
- Monitor site speed with Google PageSpeed
- Check uptime with UptimeRobot
- Monitor error logs regularly

### 7.3 Regular Maintenance
```bash
# Weekly maintenance
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Monthly tasks
composer update --no-dev
php artisan migrate --force
```

## 🎯 Step 8: Custom Domain Setup (Optional)

### 8.1 Add Custom Domain
1. In InfinityFree panel: **Subdomains** → **Add Domain**
2. Point your domain's nameservers to InfinityFree
3. Update `.env` with new domain:
```env
APP_URL=https://yourdomain.com
SESSION_DOMAIN=yourdomain.com
```

### 8.2 SSL Certificate
- InfinityFree provides free SSL certificates
- Enable in control panel: **SSL Certificates**
- Force HTTPS in `.htaccess`

## 🚨 Troubleshooting

### Common Issues:

**1. 500 Internal Server Error**
```bash
# Check permissions
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/

# Check .env file
php artisan config:clear
```

**2. Database Connection Error**
- Verify database credentials in `.env`
- Check if database exists in InfinityFree panel
- Ensure database user has proper permissions

**3. Webhook Not Working**
- Check webhook secret matches
- Verify payload URL is correct
- Check `deploy.log` for errors
- Ensure `deploy.php` has execute permissions

**4. Composer Issues**
```bash
# If composer fails
rm -rf vendor/
composer install --no-dev --optimize-autoloader
```

**5. File Upload Issues**
```bash
# Create upload directories
mkdir -p public/uploads/projects
mkdir -p public/uploads/skills
mkdir -p public/uploads/profile
chmod -R 755 public/uploads/
```

## 📞 Support Resources

- **InfinityFree Documentation**: https://infinityfree.net/support
- **Laravel Documentation**: https://laravel.com/docs
- **GitHub Webhooks**: https://docs.github.com/en/webhooks

## 🎉 Success!

Once set up, your workflow becomes:
1. **Code locally** → Test changes
2. **Push to GitHub** → `git push origin main`
3. **Auto-deployment** → Site updates automatically
4. **Enjoy** → Your portfolio is always up-to-date!

---

**💡 Pro Tips:**
- Test deployments on a staging branch first
- Keep deployment logs for troubleshooting
- Monitor your site after each deployment
- Set up email notifications for failed deployments
- Regular backups are your best friend!

**🔗 Quick Links:**
- **Live Site**: https://yourdomain.infinityfreeapp.com
- **Admin Panel**: https://yourdomain.infinityfreeapp.com/secret-gateway/login
- **GitHub Repo**: https://github.com/yourusername/portfolio
- **Deployment Logs**: https://yourdomain.infinityfreeapp.com/deploy.log