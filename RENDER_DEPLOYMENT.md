# 🚀 Render Deployment Guide

Deploy your Laravel portfolio to Render with automatic GitHub integration and free hosting.

## 🎯 Why Render?

✅ **Free Tier Available** - Perfect for portfolios  
✅ **Automatic Deployments** - Push to GitHub → Auto deploy  
✅ **Docker Support** - Consistent environment  
✅ **Free Database** - PostgreSQL/MySQL included  
✅ **Custom Domains** - Professional URLs  
✅ **SSL Certificates** - Automatic HTTPS  

## 📋 Prerequisites

- GitHub account with your portfolio repository
- Render account (free signup at https://render.com)

## 🚀 Deployment Steps

### Step 1: Push to GitHub

Make sure all your code is pushed to GitHub:

```bash
git add .
git commit -m "Add Render deployment configuration"
git push origin main
```

### Step 2: Create Render Account

1. **Go to**: https://render.com
2. **Sign up** with your GitHub account
3. **Authorize** Render to access your repositories

### Step 3: Create Web Service

1. **Click "New +"** → **"Web Service"**
2. **Connect your repository**: `Sandip-2005/Sandipan_Bhunia`
3. **Configure the service**:
   - **Name**: `sandipan-portfolio`
   - **Region**: `Oregon (US West)`
   - **Branch**: `main`
   - **Runtime**: `Docker`
   - **Build Command**: `./build.sh`
   - **Start Command**: `apache2-foreground`

### Step 4: Create Database

1. **Click "New +"** → **"PostgreSQL"** (or MySQL)
2. **Configure**:
   - **Name**: `portfolio-db`
   - **Database**: `portfolio`
   - **User**: `portfolio_user`
   - **Region**: `Oregon (US West)`
   - **Plan**: `Free`

### Step 5: Configure Environment Variables

In your web service settings, add these environment variables:

```env
APP_NAME=Sandipan Bhunia Portfolio
APP_ENV=production
APP_DEBUG=false
SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database
MAIL_MAILER=log
```

**Database variables** (automatically set by Render):
- `DB_CONNECTION=mysql` (or postgresql)
- `DB_HOST` (from database)
- `DB_PORT` (from database)
- `DB_DATABASE` (from database)
- `DB_USERNAME` (from database)
- `DB_PASSWORD` (from database)

### Step 6: Deploy

1. **Click "Create Web Service"**
2. **Wait for build** (5-10 minutes for first deployment)
3. **Check logs** for any errors
4. **Visit your site** at the provided Render URL

## 🔗 Your Live URLs

After deployment:
- **Portfolio**: `https://sandipan-portfolio.onrender.com`
- **Admin Panel**: `https://sandipan-portfolio.onrender.com/secret-gateway/login`
- **Admin Credentials**: `admin` / `portfolio2024`

## 🛠️ Local Development with Docker

Test your Docker setup locally:

```bash
# Build and run with Docker Compose
docker-compose up --build

# Visit: http://localhost:8000
```

## 🔄 Automatic Deployments

Once set up, every push to GitHub automatically deploys:

```bash
git add .
git commit -m "Update portfolio"
git push origin main
# Render automatically deploys! 🚀
```

## 📊 Monitoring

- **Render Dashboard**: Monitor deployments, logs, and metrics
- **Build Logs**: Check for deployment issues
- **Runtime Logs**: Monitor application performance

## 🎨 Custom Domain (Optional)

1. **In Render Dashboard** → **Settings** → **Custom Domains**
2. **Add your domain**: `sandipanbhunia.com`
3. **Update DNS** with provided CNAME records
4. **SSL certificate** automatically provisioned

## 🔧 Troubleshooting

### Build Fails
- Check `build.sh` permissions: `chmod +x build.sh`
- Review build logs in Render dashboard
- Ensure all dependencies in `composer.json`

### Database Connection Issues
- Verify database environment variables
- Check database is in same region as web service
- Review connection logs

### File Permissions
- Docker handles permissions automatically
- Check `storage/` and `bootstrap/cache/` are writable

## 📈 Performance Optimization

### Free Tier Limitations
- **Sleep after 15 minutes** of inactivity
- **750 hours/month** (sufficient for portfolios)
- **Slower cold starts** (first request after sleep)

### Upgrade Benefits
- **No sleep** on paid plans
- **Faster builds** and deployments
- **More resources** (CPU, RAM)

## 🔒 Security

- **Automatic HTTPS** with SSL certificates
- **Environment variables** for sensitive data
- **No exposed credentials** in code
- **Regular security updates** via Docker base images

## 💰 Cost

- **Free Tier**: Perfect for portfolios
- **Paid Plans**: Start at $7/month for always-on services
- **Database**: Free PostgreSQL included

## 🎯 Next Steps

1. **Deploy to Render** following the steps above
2. **Test your portfolio** thoroughly
3. **Set up custom domain** (optional)
4. **Monitor performance** and logs
5. **Enjoy automatic deployments**! 🎉

---

**🚀 Your portfolio will be live at**: `https://sandipan-portfolio.onrender.com`

**📱 Mobile-optimized, fast, and professional!**